<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auction\AuctionRequest;
use App\Http\Requests\Api\Auction\UpdateStatusAuctionRequest;
use App\Http\Resources\AuctionResource;
use App\Http\Resources\CommitAuctionResource;
use App\Http\Resources\MyAuctionResource;
use App\Http\Resources\UpdateStatusAuctionResource;
use App\Services\AuctionService;
use App\Traits\HttpResponse;
use Illuminate\Http\Request;

class AuctionController extends Controller
{
    use HttpResponse;

    public function __construct(public AuctionService $auctionService)
    {}

    public function index(Request $request)
    {
        $limit = request()->get('limit', 10);
        $auctions = $this->auctionService->getAll($request->all(),$limit);
        return $this->paginatedResponse($auctions, AuctionResource::class);

    }

    public function show($id)
    {
        $auction = $this->auctionService->getById($id);
        return $this->okResponse(new AuctionResource($auction), __('Commit Auction created successfully', [], request()->header('Accept-language')));

    }


    public function UpdateStatusAuction($id)
    {
        $auction = $this->auctionService->UpdateStatusAuction($id);
        return $this->okResponse(new UpdateStatusAuctionResource($auction), __('Commit Auction updated successfully', [], request()->header('Accept-language')));
    }

}
