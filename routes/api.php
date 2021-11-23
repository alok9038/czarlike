<?php

use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\MainController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\LocationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/countries', [LocationController::class, 'fetchCountries']);
Route::post('/states', [LocationController::class, 'fetchState']);
Route::post('/cities', [LocationController::class, 'fetchCity']);

Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);

Route::post('/categories',[MainController::class,'categories']);

Route::get('/featured-products',[MainController::class,'featured_products']);
Route::get('/products',[MainController::class,'products']);
Route::get('/deals-of-the-day',[MainController::class,'deal_of_the_day']);

Route::post('/get-product',[MainController::class,'product']);

Route::group(['middleware' => 'auth:sanctum'], function(){

    Route::post('/get-wishlists',[UserController::class,'wishlist']);
    Route::post('/add-to-wishlists',[UserController::class,'addWishlist']);
    Route::post('/remove-from-wishlists',[UserController::class,'removeWishlist']);

    Route::get('/get-cart-items',[CartController::class,'cartItem']);
    Route::post('/add-to-cart',[CartController::class,'addToCart']);

});

