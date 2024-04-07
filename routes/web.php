<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\Shopping;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/logout', [Dashboard::class, 'Logout'])->name('logout');


Route::get('/dashboard', [Dashboard::class, 'Index'])->name('index');
Route::get('/dashboard/products', [Dashboard::class, 'GetProducts'])->name('products');
Route::post('/dashboard/createproduct', [Dashboard::class, 'CreateProduct'])->name('createproduct');
Route::get('/dashboard/deleteproduct/{id}', [Dashboard::class, 'DeleteProduct'])->name('deleteproduct');
Route::post('/dashboard/updateproduct', [Dashboard::class, 'UpdateProduct'])->name('updateproduct');
Route::post('/dashboard/searchproducts', [Dashboard::class, 'SearchProducts'])->name('searchproducts');
Route::get('/dashboard/showproducts', [Dashboard::class, 'ShowProducts'])->name('showproducts');

Route::get('/dashboard/productdetails', [Dashboard::class, 'GetProductDetails'])->name('productDetails');
Route::post('/dashboard/createproductdetail', [Dashboard::class, 'CreateProductDetails'])->name('createproductdetails');
Route::get('/dashboard/deleteproductdetail/{id}', [Dashboard::class, 'DeleteProductDetail'])->name('deleteproductdetail');
Route::post('/dashboard/updateproductdetail', [Dashboard::class, 'UpdateProductDetail'])->name('updateproductdetail');
Route::post('/dashboard/searchproductdetail', [Dashboard::class, 'SearchProductDetail'])->name('searchproductdetail');
Route::get('/dashboard/showproductdetail', [Dashboard::class, 'ShowProductDetail'])->name('showproductdetail');



Route::get('/shopping/listItem', [Shopping::class, 'ShowListItem'])->name('listItem');
Route::get('/shopping/details/{id}', [Shopping::class, 'ShowDetail'])->name('details');
Route::get('/shopping/addtocart/{id}', [Shopping::class, 'AddToCart'])->name('addtocart');



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
