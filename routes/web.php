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

Route::get('/plan-your-visit', function () {
    return view('ivplanvisit');
})->name('visit');

Route::get('/about-us', function () {
    return view('aboutus');
})->name('aboutus');