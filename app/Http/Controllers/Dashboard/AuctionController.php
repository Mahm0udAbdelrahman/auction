<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Auction;
use Illuminate\Http\Request;
use App\Models\CommitAuction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Auction\AuctionUpdateRequest;

class AuctionController extends Controller
{
    // public function index()
    // {
    //     $auctions = Auction::with(['user', 'car', 'winner'])->latest()->paginate(10);
    //     return view('admin.auctions.index', compact('auctions'));
    // }

    public function index(Request $request)
{
    $auctions = Auction::with(['user', 'car', 'winner'])
        ->when($request->filled('month'), fn($query) => $query->whereMonth('created_at', $request->month))
        ->when($request->filled('status'), fn($query) => $query->where('status', $request->status))
        ->when($request->filled('user'), fn($query) => $query->whereHas('user', fn($q) => $q->where('name', 'like', '%' . $request->user . '%')))
        ->latest()
        ->paginate(10)
        ->appends($request->query()); 

    return view('admin.auctions.index', compact('auctions'));
}


    public function show($id)
    {
        $auction = Auction::findOrFail($id);
        return view('admin.auctions.show', compact('auction'));
    }
    
     public function update($id,AuctionUpdateRequest $request)
    {
        $data = $request->validated();
        $auction = Auction::findOrFail($id);
        $highestCommit = CommitAuction::findOrFail($data['commit_id']);
        if($data['status'] == 'won')
        {
        $auction->car->update(['sold' => 1 , 'status' => 'sold']);
        $auction->update([
            'status'       => 'won',
            'winner_id'    => $highestCommit->user_id,
            'winner_price' => $highestCommit->price,
            'winner_date'  => now(),
        ]);
        }else{
        $auction->car->update(['sold' => 0 , 'status' => 'approved']);
         $auction->update([
            'status'       => 'pending',
            'winner_id'    => null,
            'winner_price' => null,
            'winner_date'  => null,
        ]);
        }

        return redirect()->back();

    }
    public function destroy($id)
    {
        $auction = Auction::findOrFail($id);
        $auction->delete();
        return redirect()->route('Admin.auctions.index')->with('success', __('Auction deleted successfully.'));
    }
}
