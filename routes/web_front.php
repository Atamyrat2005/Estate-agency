<?php

use App\Http\Controllers\Front\EstateController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\MessageController;
use Illuminate\Support\Facades\Route;
use Spatie\Honeypot\ProtectAgainstSpam;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/language/{key}', [HomeController::class, 'language'])->name('language');

Route::controller(MessageController::class)->group(function () {
    Route::get('/message', 'index')->name('message')->middleware(ProtectAgainstSpam::class);
    Route::post('/message/store', 'store')->name('message.store')->middleware(ProtectAgainstSpam::class);
    });
Route::controller(EstateController::class)->group(function () {
    Route::get('/estates', 'index')->name('estates');
    Route::get('/atamyrat','atamyrat')->name('atamyrat');
    Route::get('/estate/{slug}', 'show')->name('estate')->where('slug', '[0-9A-Za-z-]+');
    Route::get('/estate/{slug}/favorite', 'favorite')->name('estate.favorite')->where('slug', '[0-9A-Za-z-]+');
});