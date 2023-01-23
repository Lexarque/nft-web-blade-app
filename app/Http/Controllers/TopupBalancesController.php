<?php

namespace App\Http\Controllers;

use App\Models\TopupBalances;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TopupBalancesController extends Controller
{
    public function index () {
        $datas = TopupBalances::orderByDesc('created_at')->get();
        return view('wallet.index', ['datas' => $datas]);
    }

    public function form () {
        return view('wallet.form');
    }
    
    public function save (Request $request) {
        TopupBalances::create([
            'status' => 'Pending',
            'total' => $request->total,
            'user_id' => Auth::user()->id
        ]);
        
        return redirect('/');
    }

    public function approval (Request $request, $id) {
        $data = TopupBalances::where('id', $id)->first();
        $dataUser = $data->user;

        $data->update([
            'status' => $request->status,
        ]);

        $dataUser->update([
            'balance' => $data->user->balance + $data->total
        ]);

        $datas = TopupBalances::get();
        return view('wallet.index', ['datas' => $datas]);
    }
}
