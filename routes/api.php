<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\PriceTypeController;



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::apiResource('categories', CategoryController::class);

Route::apiResource('price-type', PriceTypeController::class);
// Route::get('price-type', [PriceTypeController::class, 'index']);
// Route::post('price-type', [PriceTypeController::class, 'store']);


