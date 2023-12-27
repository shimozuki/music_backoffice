<?php

use App\Http\Controllers\API\AllapiController;
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

Route::get('/get-all', [AllapiController::class, 'musikall']);
Route::get('/get-about', [AllapiController::class, 'getabout']);
Route::get('/Sejarah_mumu', [AllapiController::class, 'sejarah']);
Route::post('/get-byid', [AllapiController::class, 'getbyid']);
Route::post('/upload', [AllapiController::class, 'upload']);
