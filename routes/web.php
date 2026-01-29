<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('mainpage');
})->name('home');

Route::get('/enter-metta-city', function () {
    return view('iientermettacity');
})->name('enter.metta.city');

Route::get('/ticketing', function () {
    return view('iiiticketing');
})->name('ticketing');