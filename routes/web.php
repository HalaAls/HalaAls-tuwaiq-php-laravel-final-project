<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard;


Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', [Dashboard::class, 'Index'])->name('index');
Route::get('/dashboard/products', [Dashboard::class, 'GetProducts'])->name('products');
Route::post('/dashboard/createproduct', [Dashboard::class, 'CreateProduct'])->name('createproduct');
Route::get('/dashboard/deleteproduct/{id}', [Dashboard::class, 'DeleteProduct'])->name('deleteproduct');
Route::post('/dashboard/updateproduct', [Dashboard::class, 'UpdateProduct'])->name('updateproduct');
Route::post('/dashboard/searchproducts', [Dashboard::class, 'SearchProducts'])->name('searchproducts');
Route::get('/dashboard/showproducts', [Dashboard::class, 'ShowProducts'])->name('showproducts');




Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
