<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('home');
});

Auth::routes();

Route::group(["middleware" => "auth"], function() {
    Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    
    /** Profile routes */
    Route::get('profile', [App\Http\Controllers\HomeController::class, 'profile'])->name('profile');
    Route::post('profile', [App\Http\Controllers\HomeController::class, 'profileUpdate'])->name('profile.update');
    Route::post('profile/password', [App\Http\Controllers\HomeController::class, 'passwordUpdate'])->name('userpassword.change');

    /** Expence routes */
    Route::get('expence', [App\Http\Controllers\ExpenceController::class, 'index'])->name('expence');
    Route::post('expence', [App\Http\Controllers\ExpenceController::class, 'getData'])->name('expence.getData');
    Route::post('expence/delete', [App\Http\Controllers\ExpenceController::class, 'delete'])->name('expence.delete');
    Route::get('expence/item/add', [App\Http\Controllers\ProductController::class, 'create'])->name('expence.add');
    Route::post('expence/item/add', [App\Http\Controllers\ProductController::class, 'store'])->name('expence.add.post');

    /** Product routes */
    Route::get('products', [App\Http\Controllers\ProductController::class, 'index'])->name('products.index');
    Route::post('products', [App\Http\Controllers\ProductController::class, 'getData'])->name('products.getData');
    Route::post('products/changeState', [App\Http\Controllers\ProductController::class, 'statechange'])->name('products.changeState');
    Route::get('used-products', [App\Http\Controllers\ProductController::class, 'usedProducts'])->name('products.usedProducts');
    Route::post('used-products', [App\Http\Controllers\ProductController::class, 'usedProductsData'])->name('products.usedProductsData');
    Route::get('spoiled-products', [App\Http\Controllers\ProductController::class, 'spoiledProducts'])->name('products.spoiledProducts');
    Route::post('spoiled-products', [App\Http\Controllers\ProductController::class, 'spoiledProductsData'])->name('products.spoiledProductsData');

    /** Purchase List */
    Route::get('purchase-list', [App\Http\Controllers\PurchaseListController::class, 'index'])->name('purchase-list.index');
    Route::post('purchase-list', [App\Http\Controllers\PurchaseListController::class, 'getData'])->name('purchase-list.getData');
    Route::post('purchase-list/delete', [App\Http\Controllers\PurchaseListController::class, 'delete'])->name('purchase-list.delete');
    Route::get('purchase-list/create', [App\Http\Controllers\PurchaseListController::class, 'create'])->name('purchase-list.create');
    Route::post('purchase-list/store', [App\Http\Controllers\PurchaseListController::class, 'store'])->name('purchase-list.store');
});
