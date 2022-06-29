<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('vouchers/check', [ApiController::class, 'checkVoucher']);

Route::post('auth/token', [ApiController::class, 'authenticate']);

// Ruta protegida por JWT
Route::get('client/vouchers', [ApiController::class, 'getClientVouchers'])->middleware('jwt');

