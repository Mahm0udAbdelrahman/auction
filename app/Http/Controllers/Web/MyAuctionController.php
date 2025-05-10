<?php

namespace App\Http\Controllers\Web;

use App\Models\CarType;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Services\MyAuctionService;
use App\Http\Controllers\Controller;

class MyAuctionController extends Controller
{
    public function __construct(public MyAuctionService $myAuctionService)
    {}
    public function getMyAuction(Request $request)
    {
        $limit = request()->get('limit', 9);
        $auctions = $this->myAuctionService->getMyAuction($request->all(),$limit);
        $countries = Country::all();
        $types = CarType::all();
        return view('web.pages.my_auction',data: compact('auctions','countries','types'));
    }


}
