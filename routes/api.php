<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CheckEmailController;

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


Route::middleware('auth')->group(function () {
    Route::post('{company}/check-email', CheckEmailController::class)
        ->name('api.company.check-email');
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
