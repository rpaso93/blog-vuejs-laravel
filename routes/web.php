<?php

use App\Http\Controllers\PagesController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PagesController::class, 'index'])->name('home');

Route::get('/login', [PagesController::class, 'login'])->name('login');

Route::get('/register', [PagesController::class, 'register'])->name('register');

Route::get('/admin', [PagesController::class, 'admin'])->middleware('auth')->name('admin');
