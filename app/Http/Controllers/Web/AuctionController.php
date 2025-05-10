<?php

namespace App\Http\Controllers\Web;

use App\Models\User;
use App\Models\Auction;
use App\Models\CarType;
use App\Models\Country;
use App\Models\Insurance;
use App\Events\AuctionEvent;
use App\Services\CarService;
use Illuminate\Http\Request;
use App\Models\CommitAuction;
use App\Services\AuctionService;
use App\Http\Controllers\Controller;
use App\Helpers\SendNotificationHelper;
use Illuminate\Support\Facades\Notification;
use App\Notifications\DBFireBaseNotification;
use App\Http\Requests\Web\Auction\AuctionRequest;
use App\Http\Requests\Web\Auction\UpdateStatusAuctionRequest;

class AuctionController extends Controller
{
    public function __construct(public AuctionService $auctionService , public CarService $carService)
    {}

    public function index(Request $request)
    {
        $limit = request()->get('limit', 9);
        $auctions = $this->auctionService->getAll($request->all(),$limit);
        
        $countries = Country::all();
        $types = CarType::all();

        return view('web.pages.auctions',compact('auctions','countries','types'));

    }

    public function filter(Request $request){
        $filters = $request->all();
        $cars = $this->carService->filterCars($filters);
        return response()->json($cars);
    }

    public function show($id)
    {
        $auction = $this->auctionService->getById($id);
        return view('web.pages.aution_details',compact('auction'));

    }

    public function finishAuction($id)
    {
        $auction = Auction::findOrFail($id);
        $commit = CommitAuction::where('auction_id',$auction->id)->orderBy('price', 'desc')
        ->value('price');
        return view('web.pages.finish_auction',compact('auction' , 'commit'));

    }


    public function UpdateStatusAuction($id)
    {
        $auction = $this->auctionService->UpdateStatusAuction($id);
        return redirect()->route('web.my_autions');
    }

}
