<?php

namespace App\Http\Controllers\Api;

use App\Traits\HttpResponse;
use Illuminate\Http\Request;
use App\Services\MyAuctionService;
use App\Http\Controllers\Controller;
use App\Http\Resources\AuctionResource;
use App\Http\Resources\CarResource;


class MyAuctionController extends Controller
{
    use HttpResponse;

    public function __construct(public MyAuctionService $myAuctionService)
    {}
    public function getMyAuction(Request $request)
    {
        $limit = request()->get('limit', 10);
        $auctions = $this->myAuctionService->getMyAuction($request->all(),$limit);
        return $this->paginatedResponse($auctions, CarResource::class);

        
        // return $this->paginatedResponse($auctions, AuctionResource::class);
        
    }

}
