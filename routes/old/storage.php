<?php

/*===================================================IMAGE ROUTES===========================================================================*/

use Illuminate\Support\Facades\Route;

Route::get('/storage/image/product/{file}', function ($file) {
    $path = storage_path("app/images/products/$file");
    if (!file_exists($path))
        $path = storage_path('app/images/default.png');
    return response()->file($path);
})->name('productImg');

Route::get('/storage/image/category/{file}', function ($file) {
    $path = storage_path("app/images/categories/$file");
    if (!file_exists($path))
        $path = storage_path('app/images/default.png');
    return response()->file($path);
})->name('categoryImg');

Route::get('/image/brands/{file}', function ($file) {
    $path = storage_path("app/images/brands/$file");
    if (!file_exists($path))
        $path = storage_path('app/images/default.png');
    return response()->file($path);
})->name('brandImg');
