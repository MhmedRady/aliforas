<?php

/*===================================================IMAGE ROUTES===========================================================================*/

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

Route::get('/storage/uploads/{width}x{height}/{category}/{file}', function ($width, $height, $category, $file) {
    $disk = Storage::disk('public');
    if ($disk->exists("uploads/$category/$file")) {
        $image = Image::make($disk->path("uploads/{$category}/$file"))->resize($width, $height);
        if (!$disk->exists("uploads/{$width}x{$height}/$category"))
            $disk->makeDirectory("uploads/{$width}x{$height}/$category");
        $image->save($disk->path("uploads/{$width}x{$height}/$category/$file"));
        return $image->response();
    }
    return Image::make($disk->path('uploads/default.png'))->resize($width, $height)->response();
});
Route::get('/storage/uploads/{width}x{height}/{file}', function ($width, $height, $file) {
    $disk = Storage::disk('public');
    if ($disk->exists("uploads/$file")) {
        $image = Image::make($disk->path("uploads/$file"))->resize($width, $height);
        if (!$disk->exists("uploads/{$width}x{$height}"))
            $disk->makeDirectory("uploads/{$width}x{$height}");
        $image->save($disk->path("uploads/{$width}x{$height}/$file"));
        return $image->response();
    }
    return Image::make($disk->path('uploads/default.png'))->resize($width, $height)->response();
});


/*Route::get('/storage/uploads/products/{file}', function ($file) {
    $path = storage_path("app/images/products/$file");
    if (!file_exists($path))
        $path = storage_path('app/images/default.png');
    return response()->file($path);
})->name('productImg');

Route::get('/image/brands/{file}', function ($file) {
    $path = storage_path("app/images/brands/$file");
    if (!file_exists($path))
        $path = storage_path('app/images/default.png');
    return response()->file($path);
})->name('brandImg');*/
