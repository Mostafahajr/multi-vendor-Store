<?php

use App\Http\Controllers\Admin\DashController;
// use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProfileController;


Route::get('/', function () {
    return view('welcome');
});


// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });


Route::middleware(['auth'])->group(function (){
    Route::get('/profile',[ProfileController::class,'edit'])->name('profile');
    Route::patch('/profile/edit',[ProfileController::class,'update'])->name('profile.update');
});


require __DIR__.'/auth.php';

require __DIR__.'/admin.php';
