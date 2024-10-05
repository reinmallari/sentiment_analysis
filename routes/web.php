<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages/sentiment');
});

Route::get('/fetch_list', [App\Http\Controllers\SentimentController::class, 'fetch_list'])->name('fetch_list');
Route::post('/add_sentiment', [App\Http\Controllers\SentimentController::class, 'add_sentiment'])->name('add_sentiment');
Route::get('/sentiment/data', [App\Http\Controllers\SentimentController::class, 'get_data']);
