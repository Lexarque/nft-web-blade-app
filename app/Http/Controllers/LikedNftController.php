<?php

namespace App\Http\Controllers;

use App\Models\LikedNft;
use App\Models\NftEntities;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikedNftController extends Controller
{
    public function postLikeData($nft_id)
    {
        LikedNft::create([
            'nft_id' => $nft_id,
            'user_id' => Auth::user()->id
        ]);

        $data = NftEntities::where('id', $nft_id)->with('bidHistory')->first();
        $likeData = LikedNft::where([['nft_id', $nft_id], ['user_id', Auth::user()->id]])->first();
        return view('nft_entities.detail', ['data' => $data, 'like' => $likeData]);
    }

    public function deleteLikeData($nft_id)
    {
        LikedNft::where([['nft_id', $nft_id], ['user_id', Auth::user()->id]])->delete();
        $data = NftEntities::where('id', $nft_id)->with('bidHistory')->first();
        $likeData = LikedNft::where([['nft_id', $nft_id], ['user_id', Auth::user()->id]])->first();
        return view('nft_entities.detail', ['data' => $data, 'like' => $likeData]);
    }
}
