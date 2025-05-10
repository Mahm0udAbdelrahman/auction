<?php
namespace App\Services;

use App\Models\User;
use App\Models\Auction;
use App\Models\Insurance;
use App\Events\AuctionEvent;
use Illuminate\Http\Request;
use App\Models\CommitAuction;
use App\Models\BalanceInsurance;
use App\Helpers\SendNotificationHelper;
use Illuminate\Support\Facades\Notification;
use App\Notifications\DBFireBaseNotification;
use App\Exceptions\InsuranceNotFoundException;
use App\Notifications\DashboardNotification;


class AuctionService
{
    public function __construct(public Auction $auction){}
    public function getAll($data,$limit)
    {

        return $this->auction->with(['user', 'car'])->filter($data)
        ->whereHas('car', function ($query) use ($data) {
            $query->filter($data);
        })->
        pending()->latest()->paginate($limit);
    }

    public function getById($id)
    {
        return $this->auction->with(['user', 'car'])->findOrFail($id);
    }

    public function UpdateStatusAuction($id)
    {
        $auction = Auction::findOrFail($id);

        if ($auction->car->user_id !== auth()->id()) {
            throw new InsuranceNotFoundException(__('You must be the owner of this car to update the auction status.', [], request()->header('Accept-language')));
        }

        if ($auction->car->sold === 1) {
            throw new InsuranceNotFoundException(__('The car has already been sold.', [], request()->header('Accept-language')));
        }

        if ($auction->status === 'won') {
            throw new InsuranceNotFoundException(__('Already won.', [], request()->header('Accept-language')));
        }

        $highestCommit = CommitAuction::where('auction_id', $auction->id)
            ->orderBy('price', 'desc')
            ->first();
           

        if (!$highestCommit) {
            throw new InsuranceNotFoundException(__('No commits found for this auction.', [], request()->header('Accept-language')));
        }

        $winnerUser = User::find($highestCommit->user_id);

        if ($winnerUser && $winnerUser->service === 'buyer' && $winnerUser->category === 'my') {
            $insurance = Insurance::where('user_id', $winnerUser->id)
                ->where('payment_status', 'paid')
                ->first();

            if (!$insurance) {
                throw new InsuranceNotFoundException(__('Insurance payment status must be paid.', [], request()->header('Accept-language')));
            }

            $minBalance = BalanceInsurance::where('service', $winnerUser->service)
                ->where('category', $winnerUser->category)
                ->value('min_balance');

            if ($insurance->balance < $minBalance) {
                throw new InsuranceNotFoundException(__("Balance is less than $minBalance.", [], request()->header('Accept-language')));
            }

            $insurance->decrement('balance', $minBalance);

            $auction->car->update(['sold' => 1 , 'status' => 'sold']);
        }
        
       $auction->car->update(['sold' => 1 , 'status' => 'sold']);
        $auction->update([
            'status'       => 'won',
            'winner_id'    => $highestCommit->user_id,
            'winner_price' => $highestCommit->price,
            'winner_date'  => now(),
        ]);

        $data = [
            "title_ar" => 'مبروك! لقد فزت بالمزاد' . $auction->car->name,
            "body_ar"  => "تهانينا! لقد فزت بالمزاد على السيارة. يرجى متابعة الخطوات لإكمال عملية الشراء.",
            "title_en" => 'Congratulations! You Won the Auction' . $auction->car->name,
            "body_en"  => "Congratulations! You have won the auction for the car. Please proceed with the steps to complete the purchase.",
            "title_ru" => 'Поздравляем! Вы выиграли аукцион' . $auction->car->name,
            "body_ru"  => "Поздравляем! Вы выиграли аукцион на автомобиль. Пожалуйста, выполните шаги для завершения покупки.",
            'image'    => null,
        ];

        $newNotification = new SendNotificationHelper();
        $user = User::findOrFail($highestCommit->user_id);
        Notification::send(
            $user,
            new DBFireBaseNotification($data['title_ar'], $data['body_ar'], $data['title_en'], $data['body_en'], $data['title_ru'], $data['body_ru'],$auction->id,$auction->car->name,$highestCommit->price,'car')
        );
         $adminUsers = User::whereHas('roles', function ($query) {
            $query->where('name', 'admin');
        })->get();
        Notification::send(
            $adminUsers,
            new DashboardNotification($auction->id, $auction->car->name, $auction->winner_price, 'auction')
        );
        $newNotification->sendNotification($data, [$user->fcm_token]);

        return $auction;
    }

}
