<?php

namespace App\Http\Controllers;

use App\Models\LikedNft;
use App\Models\NftEntities;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NftEntitiesController extends Controller
{
    const PENDING = 'Pending';
    const ACTIVE = 'Active';
    const BLACKLISTED = 'Blacklisted';

    public function index()
    {
        abort_if(Auth::user()->role->name !== 'Super Admin', 403);
        $datas = NftEntities::with(['creator'])->get();
        return view('nft_entities.index', ['datas' => $datas]);
    }

    public function detail($id)
    {
        $data = NftEntities::where('id', $id)->with(['bidHistory.user', 'bidHistory'])->first();
        Auth::check() ? $likeData = LikedNft::where([['nft_id', $id], ['user_id', Auth::user()->id]])->first() : $likeData = null;
        return view('nft_entities.detail', ['data' => $data, 'like' => $likeData]);
    }

    public function create()
    {
        $dataCount = NftEntities::count() + 1;
        return view('nft_entities.form', ['dataCount' => $dataCount]);
    }

    public function save(Request $request)
    {
        if ($request->file('image')) {
            $img = $request->file('image');
            $imgName = time() . '.' . $img->extension();
            $imgLoc = './assets/img/';
            $imgFullName = $imgLoc . $imgName;
            $img->move(public_path($imgLoc), $imgFullName);
        }

        NftEntities::create([
            'name' => $request->name,
            'nft_number' => '#' . NftEntities::count() + 1,
            'contract_id' => '0x' . Str::uuid(),
            'description' => $request->description,
            'price' => $request->price,
            'image' => $imgFullName,
            'status' => self::PENDING,
            'created_by' => auth()->id()
        ]);

        if (Auth::user()->role->name == 'Super Admin') {
            $datas = NftEntities::get();
            return view('nft_entities.index', ['datas' => $datas]);
        } else {
            return redirect('/users/detail/'.Auth::user()->id.
            '/creation');
        }
    }

    public function edit($id)
    {
        $data = NftEntities::where('id', $id)->with('creator')->first();
        if (Auth::user()->name != $data->creator->name) {
            if (Auth::user()->role->name !== 'Super Admin') {
                abort(403);
            }
        }
        $dataCount = NftEntities::count() + 1;
        return view('nft_entities.form')->with(['data' => $data, 'dataCount' => $dataCount]);
    }

    public function update(Request $request, $id)
    {
        $data = NftEntities::where('id', $id)->with('creator')->first();
        if (Auth::user()->name != $data->creator->name) {
            if (Auth::user()->role->name !== 'Super Admin') {
                abort(403);
            }
        }
        $data->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
        ]);

        if (Auth::user()->role->name == 'Super Admin') {
            $datas = NftEntities::get();
            return view('nft_entities.index', ['datas' => $datas]);
        } else {
            return redirect("/nft/detail/$data->id");
        }
    }

    public function updateNftStatus (Request $request, $id) {
        $data = NftEntities::where('id', $id)->first();
        $status = $request->status == 'Approved' ? 'Approved' : 'Blacklisted';
        $data->update([
            'status' => $status
        ]);
        return redirect('/nft/detail/'.$data->id)->with(['data' => $data]);
    }

    public function delete($id)
    {
        $data = NftEntities::where('id', $id)->with('creator')->first();
        if (Auth::user()->name != $data->creator->name) {
            if (Auth::user()->role->name !== 'Super Admin') {
                abort(403);
            }
        }
        NftEntities::where('id', $id)->delete();
        if (Auth::user()->role->name == 'Super Admin') {
            $datas = NftEntities::get();
            return view('nft_entities.index', ['datas' => $datas]);
        } else {
            return redirect("/nft/detail/$data->id");
        }
    }
}
