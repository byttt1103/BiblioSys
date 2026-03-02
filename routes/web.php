<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);
Route::get('/books', [HomeController::class, 'book_list']);
Route::get('/books/create', [HomeController::class, 'book_create']);
Route::get('/books/{book_id}', [HomeController::class, 'book_info'])->name('book.info');
