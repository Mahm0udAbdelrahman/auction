<?php

namespace App\Http\Controllers\Api;

use App\Traits\HttpResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\CommitAuctionService;
use App\Http\Resources\MyAuctionResource;
use App\Http\Resources\CommitAuctionResource;
use App\Http\Resources\MyCommitAuctionResource;
use App\Http\Requests\Api\Auction\AuctionRequest;

class CommitAuctionController extends Controller
{
    use HttpResponse;

    public function __construct(public CommitAuctionService $commitAuctionService)
    {}

        public function getMyCommitAuctions()
        {
            $limit = request()->get('limit', 10);
            $auctions = $this->commitAuctionService->getMyCommitAuctions($limit);
            return $this->paginatedResponse($auctions, MyCommitAuctionResource::class);
        }

        public function commitAuction($id, AuctionRequest $request)
        {
            $auction = $this->commitAuctionService->commitAuction($id, $request->validated());
            return $this->okResponse(new CommitAuctionResource($auction), __('Commit Auction created successfully', [], request()->header('Accept-language')));
        }
}
