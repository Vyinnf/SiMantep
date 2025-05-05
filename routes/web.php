<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});


Route::get('/login/mahasiswa', function () {
    return view('auth.login-mahasiswa');
})->name ('mahasiswa.login');

Route::get('/register/mahasiswa', function () {
    return view('auth.register-mahasiswa');
})->name ('mahasiswa.register');