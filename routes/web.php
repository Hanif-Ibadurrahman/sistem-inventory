<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\InformationController;
use Laravel\Jetstream\Http\Controllers\Livewire\UserProfileController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::group(['middleware' => ['web']], function () {
	Route::get('/', [HomeController::class, 'index']);

	Route::group(['middleware' => ['auth', 'verified']], function () {
	Route::get('dashboard', [HomeController::class, 'index']);
	Route::get('/', [HomeController::class, 'index']);

	Route::group(['middleware' => ['auth', 'role:member']], function () {
	    Route::resource('peminjaman', PeminjamanController::class);
	    Route::get('daftar-peminjaman', [PeminjamanController::class, 'daftar']);
	    Route::get('daftar-peminjaman/{no_peminjaman}', [PeminjamanController::class, 'cancel'])->name('peminjaman.cancel');
	    Route::get('daftar-peminjaman/{no_peminjaman}/qrcode', [PeminjamanController::class, 'qrcode'])->name('peminjaman.qrcode');
	    Route::get('daftar-peminjaman/{no_peminjaman}/return', [PeminjamanController::class, 'return'])->name('peminjaman.return');
	    Route::get('history', [PeminjamanController::class, 'history']);
	    Route::post('history', [PeminjamanController::class, 'search'])->name('peminjaman.search');
	    Route::get('profile', [UserProfileController::class, 'show'])->name('profile.show');

	});

	// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    // 	return view('dashboard');
	// })->name('dashboard');

	Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'role:admin']], function () {
	    Route::resource('inventory', InventoryController::class);
	    Route::resource('setting', SettingController::class);
	    Route::resource('information', InformationController::class);
	    Route::get('history', [PeminjamanController::class, 'riwayat'])->name('peminjaman.riwayat');
	    Route::post('history', [PeminjamanController::class, 'cari'])->name('peminjaman.cari');
	    Route::get('inventory/{id}/lock', [InventoryController::class, 'lock'])->name('inventory.lock');
	    Route::get('inventory/{id}/unlock', [InventoryController::class, 'unlock'])->name('inventory.unlock');
	    Route::get('inventory/{id}/active', [InventoryController::class, 'active'])->name('inventory.active');
	    Route::get('inventory/{id}/disabled', [InventoryController::class, 'disabled'])->name('inventory.disabled');
   	    Route::get('profile', [UserProfileController::class, 'show'])->name('profile.show');
   	    Route::get('history/excel', [PeminjamanController::class, 'excel'])->name('peminjaman.excel');
   	    Route::get('history/pdf', [PeminjamanController::class, 'pdf'])->name('peminjaman.pdf');
	});
	
	
	
	});
});