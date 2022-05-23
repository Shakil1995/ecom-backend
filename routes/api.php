<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\PriceTypeController;



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('categories', CategoryController::class);
Route::get('categories/toggle-status/{category}', [CategoryController::class, 'toggleStatus'])->name('categories.toggleStatus');

Route::apiResource('products', ProductController::class);
Route::get('products/toggle-status/{product}', [ProductController::class, 'toggleStatus'])->name('products.toggleStatus');

Route::apiResource('price-types', PriceTypeController::class);
Route::get('price-types/toggle-status/{priceType}', [PriceTypeController::class, 'toggleStatus'])->name('price-types.toggleStatus');

Route::post('product/price-list/{price_id}', [ProductController::class, 'priceListDestroy']); // For Product Price List Delete