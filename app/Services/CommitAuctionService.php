<?php
namespace App\Services;

use App\Models\User;
use App\Models\Auction;
use App\Models\Insurance;
use App\Events\AuctionEvent;
use App\Models\CommitAuction;
use App\Models\BalanceInsurance;
use Illuminate\Support\Facades\DB;
use App\Helpers\SendNotificationHelper;
use Illuminate\Support\Facades\Notification;
use App\Notifications\DBFireBaseNotification;
use App\Exceptions\InsuranceNotFoundException;
use Illuminate\Pagination\LengthAwarePaginator;

class CommitAuctionService
{
 public function getMyCommitAuctions($data, $limit = 10)
{
    if (!is_array($data)) {
        $data = [];
    }

    return CommitAuction::where('user_id', auth()->id())
        ->with(['user', 'auction.car'])
        ->whereHas('auction', function ($query) use ($data) {
            $query->filter($data)
                ->whereHas('car', function ($carQuery) use ($data) {
                    $carQuery->filter($data);
                });
        })
        ->whereIn('id', function ($query) {
            $query->selectRaw('MAX(id)')
                ->from('commit_auctions')
                ->whereColumn('commit_auctions.auction_id', 'auction_id')
                ->where('user_id', auth()->id())
                ->groupBy('auction_id');
        })
        ->latest()
        ->paginate($limit);
}





    public function commitAuction($id, array $data)
    {
        $user    = auth()->user();
        $auction = Auction::findOrFail($id);
        
        if ($auction->status == 'won') {
            throw new InsuranceNotFoundException(__('The auction has already been won.', [], request()->header('Accept-language')));
        }

        if ($user->service !== 'buyer' && $auction->user_id !== $user->id) {
            throw new InsuranceNotFoundException(__('You must be a buyer or the owner of this auction to commit.', [], request()->header('Accept-language')));
        }

        $minBalance = BalanceInsurance::where('service', $user->service)
            ->where('category', $user->category)
            ->value('min_balance');

        if (is_null($minBalance)) {
            throw new InsuranceNotFoundException(__('Invalid category or service.', [], request()->header('Accept-language')));
        }

        $insurance = Insurance::where('user_id', $user->id)->first();

        if (! $insurance) {
            throw new InsuranceNotFoundException(__('No insurance record found for the user.', [], request()->header('Accept-language')), 402);
        }

        if ($insurance->balance < $minBalance) {
            throw new InsuranceNotFoundException(__('Your insurance balance must be at least :minBalance.', [
                'minBalance' => $minBalance,
            ], request()->header('Accept-language')));
        }

        if ($insurance->payment_status !== 'paid') {
            throw new InsuranceNotFoundException(__('Your insurance payment status must be paid to add a car.', [], request()->header('Accept-language')));
        }

        $startPrice   = $auction->start_price;
        $highestPrice = CommitAuction::where('auction_id', $auction->id)->max('price');

        if ($data['price'] <= $startPrice) {
            throw new InsuranceNotFoundException(__('The price must be greater than the start price of ' . $startPrice . ' EGP.', [], request()->header('Accept-language')));
        }

        if ($highestPrice && $data['price'] <= $highestPrice) {
            throw new InsuranceNotFoundException(__('The price must be higher than ' . $highestPrice . ' EGP.', [], request()->header('Accept-language')));
        }

        $commit = CommitAuction::create([
            'user_id'    => $user->id,
            'auction_id' => $auction->id,
            'price'      => $data['price'],
            'commit'     => $data['commit'] ?? null,
        ]);

       broadcast(new AuctionEvent($commit))->toOthers();
    

        $data = [
            "title_ar" => 'مزايدة جديدة على سيارتك' . $auction->car->name,
            "body_ar"  => "مرحباً، لقد تمت مزايدة جديدة على سيارتك بسعر . يمكنك متابعة تفاصيل المزايدة واتخاذ القرار المناسب.",
            "title_en" => 'New Bid on Your Car ' . $auction->car->name,
            "body_en"  => "Hello, a new bid has been placed on your car. You can check the auction details and take the appropriate action.",
            "title_ru" => 'Новая ставка на ваш автомобиль' . $auction->car->name,
            "body_ru"  => "Здравствуйте, на ваш автомобиль была сделана новая ставка. Вы можете ознакомиться с деталями аукциона и принять соответствующее решение.",
            'image'    => null,
        ];
        $newNotification = new SendNotificationHelper();
        $user            = User::findOrFail($auction->car->user->id);
        Notification::send(
            $user,
           new DBFireBaseNotification($data['title_ar'],$data['body_ar'],$data['title_en'],$data['body_en'],$data['body_ru'],$data['title_ru'],$auction->id,$auction->car->name,$commit->price,'car')
       );
        $newNotification->sendNotification($data, [$user->fcm_token]);

        return $commit;
    }

}
