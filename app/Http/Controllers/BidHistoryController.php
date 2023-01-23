<?php

namespace App\Http\Controllers;

use App\Models\BidHistory;
use App\Models\LikedNft;
use App\Models\NftEntities;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BidHistoryController extends Controller
{
    public function saveBid(Request $request, $id)
    {
        if ($request->total > Auth::user()->balance) {
            return back()->withErrors(['msg' => 'Balance insufficient, please fill your balance first']);
        }

        BidHistory::create([
            'bidder_id' => Auth::user()->id,
            'nft_id' => $id,
            'total' => $request->total,
            'type' => 'Bid'
        ]);

        $userData = User::where('id', Auth::user()->id)->first();
        $nftData = NftEntities::where('id', $id)->first();

        $userData->update([
            'balance' => $userData->balance - $nftData->price
        ]);

        $nftData->update([
            'price' => $nftData->price + (($nftData->price * 10) / 100)
        ]);

        $data = NftEntities::where('id', $id)->with('bidHistory')->first();
        $likeData = LikedNft::where('nft_id', $id)->first();
        return view('nft_entities.detail', ['data' => $data, 'like' => $likeData]);
    }

    public function buyout(Request $request, $id)
    {
        if ($request->total > Auth::user()->balance) {
            return back()->withErrors(['msg' => 'Balance insufficient, please fill your balance first']);
        }

        BidHistory::create([
            'bidder_id' => Auth::user()->id,
            'nft_id' => $id,
            'total' => $request->total,
            'type' => 'Buyout'
        ]);

        $userData = User::where('id', Auth::user()->id)->first();
        $nftData = NftEntities::where('id', $id)->first();

        $userData->update([
            'balance' => $userData->balance - $nftData->price
        ]);

        $nftData->update([
            'owned_by' => Auth::user()->id
        ]);

        $data = NftEntities::where('id', $id)->with('bidHistory')->first();
        $likeData = LikedNft::where('nft_id', $id)->first();
        return view('nft_entities.detail', ['data' => $data, 'like' => $likeData]);
    }
}
