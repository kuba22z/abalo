<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/articles', [App\Http\Controllers\ArticleController::class, 'newArticle_api'])->name('newArticle');
Route::get('/articles', [App\Http\Controllers\ArticleController::class, 'search_api'])->name('search');
Route::post('/shoppingcart', [App\Http\Controllers\ShoppingcartController::class, 'addToShoppingcart_api'])->name('AddToShoppingcart');
Route::get('/shoppingcart', [App\Http\Controllers\ShoppingcartController::class, 'getShoppingcart_api'])->name('getShoppingcart');
Route::delete('/shoppingcart/{shoppingcartid}/articles/{articleid}', [App\Http\Controllers\ShoppingcartController::class, 'deleteFromShoppingcart_api']);
Route::post('/articles/{id}/sold', [App\Http\Controllers\ArticleController::class, 'soldMessage']);
