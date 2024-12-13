<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashController;
use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;



Route::group([
    'middleware' => ['auth'],
    'prefix' => 'dashboard'
],function(){

    Route::get('/',[DashController::class,'index'])->name('dashboard');

    Route::get('/category/trash',[CategoryController::class,'trash'])->name('categories.trash');
    Route::put('/category/restore/{category}',[CategoryController::class,'restore'])->name('categories.restore');
    Route::delete('/category/{category}/force-delete',[CategoryController::class,'forceDelete'])->name('categories.force-delete');

    Route::resource('/categories', CategoryController::class);


    Route::get('/products/trash',[ProductController::class,'trash'])->name('products.trash');
    Route::put('/products/restore/{product}',[ProductController::class,'restore'])->name('products.restore');
    Route::delete('/products/{product}/force-delete',[ProductController::class,'forceDelete'])->name('products.force-delete');
    Route::resource('/products', ProductController::class);



});





