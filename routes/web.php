<?php

use App\Http\Controllers\HoroController;
use App\Http\Controllers\MangalController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/horoshow', function () {
    return view('form1');
});
Route::post('/horoshow', [HoroController::class, 'horoshow']);

// Route::get('/mangal', [MangalController::class, 'mangalshow']);