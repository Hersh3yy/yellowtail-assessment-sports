<?php

use App\Http\Controllers\MemberController;
use App\Http\Controllers\SportController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(MemberController::class)->group(function () {
    Route::get('/members', 'index');
    Route::post('/members', 'store');
    Route::delete('/members/{id}', 'destroy');
});

Route::controller(SportController::class)->group(function () {
    Route::get('/sports', 'index');
    Route::post('/sports', 'store');
});
