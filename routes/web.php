<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Shopping;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/logout', [Dashboard::class, 'Logout'])->name('logout');


Route::group([
    'prefix' => '/dashboard'
], function () {
    Route::get('/', [Dashboard::class, 'Index'])->name('index');
    Route::get('/products', [Dashboard::class, 'GetProducts'])->name('products');
    Route::post('/createproduct', [Dashboard::class, 'CreateProduct'])->name('createproduct');
    Route::get('/deleteproduct/{id}', [Dashboard::class, 'DeleteProduct'])->name('deleteproduct');
    Route::post('/updateproduct', [Dashboard::class, 'UpdateProduct'])->name('updateproduct');
    Route::post('/searchproducts', [Dashboard::class, 'SearchProducts'])->name('searchproducts');
    Route::get('/showproducts', [Dashboard::class, 'ShowProducts'])->name('showproducts');

    Route::get('/productdetails', [Dashboard::class, 'GetProductDetails'])->name('productDetails');
    Route::post('/createproductdetail', [Dashboard::class, 'CreateProductDetails'])->name('createproductdetails');
    Route::get('/deleteproductdetail/{id}', [Dashboard::class, 'DeleteProductDetail'])->name('deleteproductdetail');
    Route::post('/updateproductdetail', [Dashboard::class, 'UpdateProductDetail'])->name('updateproductdetail');
    Route::post('/searchproductdetail', [Dashboard::class, 'SearchProductDetail'])->name('searchproductdetail');
    Route::get('/showproductdetail', [Dashboard::class, 'ShowProductDetail'])->name('showproductdetail');
});


Route::group([
    'prefix' => '/shopping'
], function () {
    Route::get('/listItem', [Shopping::class, 'ShowListItem'])->name('listItem');
    Route::get('/listItem/{cat}', [Shopping::class, 'GetListItemByCat'])->name('listItembycat');

    Route::get('/details/{id}', [Shopping::class, 'ShowDetail'])->name('details');
    Route::post('/addtocart/{id}', [Shopping::class, 'AddToCart'])->name('addtocart');
    Route::get('/cart', [Shopping::class, 'ShowCart'])->name('cart');
    Route::get('/download-cart-pdf', [Shopping::class, 'downloadPDF'])->name('downloadCartPDF');

    // Route::post('/test', [Shopping::class, 'test'])->name('test');
});



Route::get('language/{locale}', function ($locale) {
    App::setLocale($locale);
    session()->put('locale', $locale);
    return redirect()->back();
});


Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

// Route::get('/cart', function () {
//     return view('shopping.cart');
// })->name('cart');
