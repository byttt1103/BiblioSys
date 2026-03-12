<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;

Route::get('/', [HomeController::class, 'index']);
Route::get('/books', [HomeController::class, 'book_list']);
Route::get('/books/create', [HomeController::class, 'book_create']);
Route::get('/books/{book_id}', [HomeController::class, 'book_info'])->name('book.info');

Route::post("/logout", [LoginController::class, 'logout'])->middleware('auth');
Route::get("/logout", [LoginController::class, 'logout'])->middleware('auth');

Route::get("/login", [LoginController::class, 'show_login_form'])->middleware('guest');
Route::post("/login", [LoginController::class, 'authenticate'])->middleware('guest');

Route::get("/register", [LoginController::class, 'show_register_form'])->middleware('guest');
Route::post("/register", [LoginController::class, 'register'])->middleware('guest');

require __DIR__.'/auth.php';

//Sobrecribimos el /dashboard que trae breeze
Route::get('/dashboard', fn () => redirect('/'))->name('dashboard');
