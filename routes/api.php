<?php

use App\Http\Controllers\client\AuthContoller as ClientAuthContoller;
use App\Http\Controllers\client\CancelOrderController;
use App\Http\Controllers\client\OrderController  as ClientOrderController;
use App\Http\Controllers\client\WatchListController;
use App\Http\Controllers\product\ProductController;
use App\Http\Controllers\search\SearchController;
use App\Http\Controllers\supply\AccountController;
use App\Http\Controllers\supply\AuthContoller as SupplyAuthContoller;
use App\Http\Controllers\supply\OrderController as SupplyOrderController;
use App\Http\Controllers\supply\ProductController as SupplyProductController;
use App\Http\Controllers\supply\ShowController;
use App\Models\Category;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('supply')->group(function () {
    Route::post('login',[SupplyAuthContoller::class,'login']);
    Route::post('register', [SupplyAuthContoller::class,'register']);
    Route::middleware('auth:supply')->post('logout', [SupplyAuthContoller::class,'logout']);
    
    Route::middleware('auth:supply')->get('/orders',[SupplyOrderController::class,'orders']);
    Route::middleware('auth:supply')->post('/accept-order',[SupplyOrderController::class,'accept']);

    Route::middleware('auth:supply')->resource('/products',SupplyProductController::class)
        ->except('edit','create');

    Route::middleware('auth:supply')->get('/account',[AccountController::class,'index']);
    Route::middleware('auth:supply')->post('/account-update/{id}',[AccountController::class,'update']);

});

Route::prefix('client')->group(function () {
    Route::post('login',[ClientAuthContoller::class,'login']);
    Route::post('register', [ClientAuthContoller::class,'register']);
    Route::middleware('auth:client')->post('logout', [ClientAuthContoller::class,'logout']);

    Route::middleware('auth:client')->get('/orders',[ClientOrderController::class,'orders']);

    Route::middleware('auth:client')->get('/order/{id}',[ClientOrderController::class,'order']);

    Route::middleware('auth:client')->post('/order',[ClientOrderController::class,'createOrder']);

    Route::middleware('auth:client')->post('/cancel-order/{orderId}',[CancelOrderController::class,'cancelOrder']);

    Route::middleware('auth:client')->get('/watch-list',[WatchListController::class,'get_list']);

    Route::middleware('auth:client')->post('/watch-list',[WatchListController::class,'update_list']);

    Route::middleware('auth:client')->get('/get-prices',[WatchListController::class,'getPrices']);
});

Route::get('/search-products',[SearchController::class,'prudoctSearch']);
Route::get('/search-suppliers',[SearchController::class,'suppliersSearch']);

Route::get('/suppliers',[ShowController::class,'index']);

Route::get('/supplier/{id}',[ShowController::class,'supplyIndex']);

Route::get('/products',[ProductController::class,'index']);

Route::get('/product/{id}',[ProductController::class,'productIndex']);

Route::get('/categories',function () {
    $categories = Category::all();
    return $categories;
});
