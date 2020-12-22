<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\InventoryController;
use App\Http\Controllers\Api\PeminjamanController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::get('loker', [AuthController::class, 'loker']); //for nodemcu
Route::post('qrcode', [AuthController::class, 'qrcode']); //for qrcode
  
Route::middleware('auth:api', 'role:admin')->group(function () {
   	Route::resource('inventory', InventoryController::class);
});

Route::middleware('auth:api', 'role:member')->group(function () {
   	Route::resource('peminjaman', PeminjamanController::class);
   	Route::get('daftar-peminjaman', [PeminjamanController::class, 'daftar']);
   	Route::get('daftar-peminjaman/{no_peminjaman}', [PeminjamanController::class, 'cancel'])->name('peminjaman.cancel');
});

	

