<?php

namespace App\Http\Controllers;

use App\Models\LikedNft;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        abort_if(Auth::user()->role->name !== 'Super Admin', 403);
        $data = User::get();
        return view('users.index', ['data' => $data]);
    }

    public function detail($id)
    {
        $data = User::where('id', $id)->first();
        return view('users.detail', ['data' => $data]);
    }

    public function userCollection($id)
    {
        $data = User::where('id', $id)->with('ownedNft')->first();
        return view('users.tabs.collection', ['data' => $data]);
    }

    public function userCreation($id)
    {
        $data = User::where('id', $id)->with('createdNft')->first();
        return view('users.tabs.creation', ['data' => $data]);
    }

    public function userLiked($id)
    {
        $data = User::where('id', $id)->first();
        $likedData = LikedNft::where('user_id', $id)->with('nft')->get();
        return view('users.tabs.liked', ['data' => $data, 'like' => $likedData]);
    }

    public function create()
    {
        abort_if(Auth::user()->role->name !== 'Super Admin', 403);
        return view('users.form');
    }

    public function save(Request $request)
    {
        abort_if(Auth::user()->role->name !== 'Super Admin', 403);
        if ($request->file('image')) {
            $img = $request->file('image');
            $imgName = time() . '.' . $img->extension();
            $imgLoc = './assets/img/';
            $imgFullName = $imgLoc . $imgName;
            $img->move(public_path($imgLoc), $imgFullName);
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'image' => $imgFullName,
            'description' => $request->description,
        ]);

        $data = User::get();
        return view('users.index', ['data' => $data]);
    }

    public function edit($id)
    {
        $data = User::where('id', $id)->first();
        if (Auth::user()->name != $data->name) {
            if (Auth::user()->role->name !== 'Super Admin') {
                abort(403);
            }
        }
        return view('users.form')->with(['data' => $data]);
    }

    public function update($id, Request $request)
    {
        $data = User::where('id', $id)->first();
        if (Auth::user()->name != $data->name) {
            if (Auth::user()->role->name !== 'Super Admin') {
                abort(403);
            }
        }

        $imgFullName = null;
        if ($request->file('image')) {
            $img = $request->file('image');
            $imgName = time() . '.' . $img->extension();
            $imgLoc = './assets/img/';
            $imgFullName = $imgLoc . $imgName;
            $img->move(public_path($imgLoc), $imgFullName);
        }

        $data->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'image' => $imgFullName ? $imgFullName : $data->image,
            'description' => $request->description,
        ]);

        if (Auth::user()->role->name == 'Super Admin') {
            $datas = User::get();
            return view('users.index', ['data' => $datas]);
        } else {
            return redirect("/users/detail/$data->id");
        }
    }

    public function delete($id)
    {
        abort_if(Auth::user()->role->name !== 'Super Admin', 403);
        User::where('id', $id)->delete();
        $data = User::get();
        return view('users.index', ['data' => $data]);
    }
}
