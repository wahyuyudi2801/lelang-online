<?php

use App\Http\Controllers\AuctionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GoodsController;
use App\Http\Controllers\UsersController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', function () {
    $barang = DB::table('goods')
    ->leftJoin('categories', 'goods.category_id', '=', 'categories.id')
    ->leftJoin('users', 'goods.user_id', '=', 'users.id')
    ->select('goods.id', 'goods.good_name', 'goods.url_good', 'categories.category_name', 'goods.open_price')
    ->where('users.status', 1)
    ->orderBy('goods.created_at', 'desc')
    ->get();

    return Inertia::render('Front/HomeAc', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
        'goods' => $barang
    ]);
})->name('home');

// backend Admin
Route::get('/admin', [DashboardController::class, 'indexAdmin'])->middleware(['auth', 'verified', 'admin'])->name('dashboardAdmin');
Route::get('/members', [UsersController::class, 'index'])->middleware(['auth', 'verified','admin'])->name('members');
Route::post('/members', [UsersController::class, 'index'])->middleware(['auth', 'verified', 'admin'])->name('members');
Route::post('/members/{id}/edit', [UsersController::class, 'update'])->middleware(['auth', 'verified', 'admin'])->name('members_update');

// back end users
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified', 'owner'])->name('dashboard');
Route::get('/profile/{id}', [DashboardController::class, 'profile'])->middleware(['auth', 'verified'])->name('profile');
Route::post('/profile/{post}/update', [DashboardController::class, 'updateProfile'])->middleware(['auth', 'verified'])->name('updateProfile');

Route::get('/auction-item', [GoodsController::class, 'index'])->middleware('auth', 'verified', 'owner')->name('auctionItem');
Route::post('/auction-item', [GoodsController::class, 'index'])->middleware('auth', 'verified', 'owner')->name('auctionItemPost');
Route::get('/auction-item&create', [GoodsController::class, 'create'])->middleware('auth', 'verified', 'owner')->name('tambahBarang');
Route::post('/auction-item&create', [GoodsController::class, 'store'])->middleware('auth', 'verified', 'owner')->name('insertBarang');
Route::get("/auction-item/{post}", [GoodsController::class, 'edit'])->middleware('auth', 'verified', 'owner')->name('editBarang');
Route::post("/auction-item/{post}", [GoodsController::class, 'update'])->middleware('auth', 'verified', 'owner')->name('updateBarang');
Route::delete("/auction-item/{id}", [GoodsController::class, 'destroy'])->middleware('auth', 'verified', 'owner')->name('deleteBarang');

// lelang
Route::get('/auctions', [AuctionController::class, 'index'])->middleware('auth', 'verified', 'owner')->name('auctions');
Route::post('/auctions', [AuctionController::class, 'index'])->middleware('auth', 'verified', 'owner')->name('auctions.show');
Route::post('/auctions/{post}/edit', [AuctionController::class, 'update'])->middleware('auth', 'verified', 'owner')->name('auctions.update');

// frond end
Route::get('/goods/{param}', [GoodsController::class, 'barang'])
    ->middleware('guest')
    ->name('goods');
// Route::post('/goods/{param}', [GoodsController::class, 'barang'])
//     ->name('goods');

Route::get('/bid/{param}', [AuctionController::class, 'frontIndex'])->middleware('guest')
    ->name('bid');
Route::post('/biding', [AuctionController::class, 'frontStore'])->middleware('guest')
    ->name('biding');
require __DIR__ . '/auth.php';
