<?php

use App\Http\Controllers\UrlController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/encode', [UrlController::class, 'encodeUrl'])->name('url.encode');
Route::get('/decode/{shortcode}', [UrlController::class, 'decodeUrl'])->name('url.decode');