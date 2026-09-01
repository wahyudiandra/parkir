<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/index', function () {
    return view('index');
});

Route::get('/dasboard', function () {
    return view('dasboard');
});

Route::get('/cara_kerja', function () {
    return view('cara_kerja');
});

Route::get('/lokasi', function () {
    return view('lokasi');
});

Route::get('/pengelola', function () {
    return view('pengelola');
});

Route::get('/bantuan', function () {
    return view('bantuan');
});