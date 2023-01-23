<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BidHistoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LikedNftController;
use App\Http\Controllers\NftEntitiesController;
use App\Http\Controllers\TopupBalancesController;
use App\Http\Controllers\UserController;
use App\Models\BidHistory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/collection', [DashboardController::class, 'collection'])->name('collection');

Route::get('/users/detail/{id}', [UserController::class, 'detail'])->name('detail-user');
Route::get('/users/detail/{id}/collection', [UserController::class, 'userCollection'])->name('user-collection');
Route::get('/users/detail/{id}/creation', [UserController::class, 'userCreation'])->name('user-creation');
Route::get('/users/detail/{id}/liked', [UserController::class, 'userLiked'])->name('user-liked');

Route::get('/nft/detail/{id}', [NftEntitiesController::class, 'detail'])->name('nft-detail');

Route::get('/login', function () { return view('auth.login'); })->name('login');
Route::post('/login/authenticate', [AuthController::class, 'authenticate'])->name('authenticate');

Route::get('/register', function () { return view('auth.register'); })->name('register');
Route::post('/register/process', [AuthController::class, 'register'])->name('register-process');

Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/nft', [NftEntitiesController::class, 'index'])->name('nft-index');
    Route::get('/nft/create', [NftEntitiesController::class, 'create'])->name('create-nft');
    Route::post('/nft/save', [NftEntitiesController::class, 'save'])->name('save-nft');
    Route::get('/nft/edit/{id}', [NftEntitiesController::class, 'edit']);
    Route::post('/nft/update/{id}', [NftEntitiesController::class, 'update']);
    Route::get('/nft/delete/{id}', [NftEntitiesController::class, 'delete']);
    Route::post('/nft/update/{id}/status', [NftEntitiesController::class, 'updateNftStatus']);

    Route::get('/users', [UserController::class, 'index'])->name('index-user');
    Route::get('/users/create', [UserController::class, 'create'])->name('create-user');
    Route::post('/users/save', [UserController::class, 'save'])->name('save-user');
    Route::get('users/edit/{id}', [UserController::class, 'edit'])->name('edit-user');
    Route::post('/users/update/{id}', [UserController::class, 'update'])->name('update-user');

    Route::get('/balance', [TopupBalancesController::class, 'index'])->name('balance-index');
    Route::get('/balance/topup/', [TopupBalancesController::class, 'form'])->name('balance-topup');
    Route::post('/balance/topup/save', [TopupBalancesController::class, 'save'])->name('balance-topup-save');
    Route::post('/balance/approval/{id}', [TopupBalancesController::class, 'approval']);

    Route::get('/nft/like/{nft_id}', [LikedNftController::class, 'postLikeData'])->name('like');
    Route::get('/nft/unlike/{nft_id}', [LikedNftController::class, 'deleteLikeData'])->name('unlike');
    Route::post('/nft/update/{id}/status', [NftEntitiesController::class, 'updateNftStatus'])->name('update-nft-status');

    Route::post('/nft/bid/{id}', [BidHistoryController::class, 'saveBid'])->name('bid-nft');
    Route::post('/nft/buyout/{id}', [BidHistoryController::class, 'buyout'])->name('buyout-nft');
});
