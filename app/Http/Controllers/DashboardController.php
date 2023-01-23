<?php

namespace App\Http\Controllers;

use App\Models\NftEntities;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index() {
        $newlyReleasedNft = NftEntities::orderByDesc('created_at')->where([['status', '!=', 'Pending'], ['status', '!=', 'Blacklisted']])->paginate(4);
        $mostPopularNft = NftEntities::withCount('bidHistory')->where([['status', '!=', 'Pending'], ['status', '!=', 'Blacklisted']])->orderByDesc('bid_history_count')->paginate(3);
        return view('dashboard', ['newNft' => $newlyReleasedNft, 'popularNft' => $mostPopularNft]);
    }

    public function collection () {
        $data = NftEntities::orderByDesc('created_at')->filter(request(['search']))->where([['status', '!=', 'Pending'], ['status', '!=', 'Blacklisted']])->paginate(12);
        return view('collection', ['data' => $data]);
    }
}
