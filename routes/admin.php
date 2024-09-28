<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\SizesController;
use Illuminate\Support\Facades\Route;

Route::domain('admin.'.config('app.domain'))->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('admin.index');
    
    Route::prefix('products')->name('admin.products.')->group(function () {
        Route::get('/', [ProductsController::class, 'index'])->name('index');
        Route::get('/create', [ProductsController::class, 'create'])->name('create');
        Route::get('/update/{product}', [ProductsController::class, 'update'])->name('update');
        Route::post('/save', [ProductsController::class, 'save'])->name('save');
        Route::post('/upload/image', [ProductsController::class, 'uploadImage'])->name('image');
        Route::delete('/{product}', [ProductsController::class, 'delete'])->name('delete');
    });

    Route::prefix('sizes')->name('admin.sizes.')->group(function () {
        Route::get('/', [SizesController::class, 'index'])->name('index');
        Route::get('/create', [SizesController::class, 'create'])->name('create');
        Route::post('/save', [SizesController::class, 'save'])->name('save');
        Route::get('/update/{size}', [SizesController::class, 'update'])->name('update');
        Route::delete('/{size}', [SizesController::class, 'delete'])->name('delete');
    });
});