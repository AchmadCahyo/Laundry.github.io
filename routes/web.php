<?php

use App\Models\User;
use App\Models\Paket;
use App\Models\Member;
use App\Models\Outlet;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\OutletController;
use App\Http\Controllers\TransaksiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/add', function () {
    $paket = Paket::all();
    return view('admin/member/add', ['paket' => $paket]);
});
Route::get('/addo', function () {
    return view('admin/outlet/addo');
});
Route::get('/addu', function () {
    $outlet = Outlet::all();
    return view('admin/pengguna/addu', ['outlet' => $outlet]);
});
Route::get('/addp', function () {
    $outlet = Outlet::all();
    return view('admin.paket.addp', ['outlet' => $outlet]);
});
Route::get('/addt', function () {
    $user = User::all();
    $outlet = Outlet::all();
    $member = Member::all();
    return view('admin/transaksi/addt', ['user' => $user, 'outlet' => $outlet, 'member' => $member]);
});

Auth::routes(['register' => false]);

Route::middleware('auth')->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('member', MemberController::class);
    Route::resource('outlet', OutletController::class);
    Route::resource('pengguna', UserController::class);
    Route::resource('paket', PaketController::class);
    Route::resource('transaksi', TransaksiController::class);
});
