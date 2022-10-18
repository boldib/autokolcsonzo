<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\RentalController;

Auth::routes();

Route::get('/', [CarController::class, 'index'])->name('index');

Route::group(['as' => 'admin.', 'middleware' => ['admin']], function () {
    Route::get('/admin',[AdminController::class, 'index'])->name('index');
    Route::get('/admin/create',[CarController::class, 'create'])->name('create');
    Route::post('/admin/store',[CarController::class, 'store'])->name('store');
    Route::get('/admin/edit/{id}/{slug}', [CarController::class, 'edit'])->name('edit');
    Route::patch('/admin/update/{id}/{slug}', [CarController::class, 'update'])->name('update');
    Route::delete('/rental/delete/{id}', [RentalController::class, 'delete'])->name('delete');
});

Route::group(['as' => 'cars.'], function () {
    Route::get('/{id}/{slug}', [CarController::class, 'show'])->name('show');
    Route::get('/datefinder', [CarController::class, 'datefinder'])->name('datefinder');
});

Route::group(['as' => 'rental.'], function () {
    Route::post('/rental/{id}', [RentalController::class, 'store'])->name('store');
    Route::delete('/rental/delete/{id}', [RentalController::class, 'delete'])->middleware('admin')->name('delete');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
