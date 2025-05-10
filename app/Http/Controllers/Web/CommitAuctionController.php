<?php

namespace App\Http\Controllers\Web;

use App\Models\User;
use App\Models\Auction;
use App\Models\CarType;
use App\Models\Country;
use App\Models\Insurance;
use App\Events\AuctionEvent;
use Illuminate\Http\Request;
use App\Models\CommitAuction;
use App\Http\Controllers\Controller;
use App\Services\CommitAuctionService;
use App\Helpers\SendNotificationHelper;
use Illuminate\Support\Facades\Notification;
use App\Notifications\DBFireBaseNotification;
use App\Http\Requests\Web\Auction\AuctionRequest;
use Illuminate\Support\Facades\Session;


class CommitAuctionController extends Controller
{

    public function __construct(public CommitAuctionService $commitAuctionService)
    {}
    public function getMyCommitAuctions(Request $request)
    {
        $limit = request()->get('limit', 9);
        $commit_auctions = $this->commitAuctionService->getMyCommitAuctions($request->all(),$limit);
        $types = CarType::all();
        $countries = Country::all();
        return view('web.pages.my_commit_aution',compact('commit_auctions','types','countries'));
    }

    public function commitAuction($id, AuctionRequest $request)
    {

        $user = auth()->user();


        $auction = Auction::findOrFail($id);

        if ($auction->status === 'won') {
            return back()->with('error',('Already won.'));
        }

        if ($user->service !== 'buyer' && $auction->user_id !== $user->id) {
            return back()->with('error',__('You must be a buyer or the owner of this auction to commit.'));

        }

        $minBalance = [
            'my' => 300,
            'dealer' => 500,
        ][$user->category] ?? null;

        if (is_null($minBalance)) {
        return back()->with('error','Invalid category.');
        }

        $insurance = Insurance::where('user_id', $user->id)->first();

        if (!$insurance) {
                return back()->with('error',__('No insurance record found for the user.'));

        }

        if ($insurance->balance < $minBalance) {
            return back()->with('error',__("Your insurance balance must be at least :minBalance.$minBalance"));


        }

        if ($insurance->payment_status !== 'paid') {
            return back()->with('error',__("Your insurance payment status must be paid to add a car."));

        }

        $startPrice = $auction->start_price;


        $highestPrice = CommitAuction::where('auction_id', $auction->id)->max('price');

        if ($request->price <= $startPrice) {
            return back()->with('error', __("The price must be greater than the start price of :startPrice.", ['startPrice' => $startPrice]));

        }
        if ($highestPrice && $request->price <= $highestPrice) {
return back()->with('error', __('The price must be higher than :highestPrice.', ['highestPrice' => $highestPrice]));


    }


        $commit = CommitAuction::create([
            'user_id'    => $user->id,
            'auction_id' => $auction->id,
            'price'      => $request->price,
            'commit'     => $request->commit ?? null,
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
        Session::flash('message', ['type' => 'success', 'text' => __('Bid Success!')]);
        return redirect()->back(); 
            // return response()->json(['message' => 'Bid placed successfully!', 'price' => $commit->price]);


    }
    
}
