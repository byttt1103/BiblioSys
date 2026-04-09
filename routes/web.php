<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NewsController;

use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\BookerMiddleware;

// All users' routes
Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/about_us', [HomeController::class, 'about'])->name('about.library');

Route::post("/logout", [LoginController::class, 'logout'])->middleware('auth')->name('logout');
Route::get("/logout", [LoginController::class, 'logout'])->middleware('auth');

Route::get("/login", [LoginController::class, 'show_login_form'])->middleware('guest')->name('login');
Route::post("/login", [LoginController::class, 'authenticate'])->middleware('guest');

Route::get("/register", [LoginController::class, 'show_register_form'])->middleware('guest')->name('register');
Route::post("/register", [LoginController::class, 'register'])->middleware('guest');

//admin routes

Route::get('/admin',[AdminController::class, 'index'])->middleware(AdminMiddleware::class)->name('admin.index');

Route::resource('/admin/books', BookController::class)->middleware(BookerMiddleware::class);
Route::resource('/admin/news', NewsController::class)->middleware(BookerMiddleware::class);

Route::get('/news/create', [NewsController::class, 'show_news_form'])->name("news_form")->middleware(AdminMiddleware::class);
Route::post('/news/create', [NewsController::class, 'create_news'])->name("news_create")->middleware(AdminMiddleware::class);

// dynamic routes
Route::get('/books', [HomeController::class, 'book_list'])->name('book.list');
Route::get('/books/{book_id}', [HomeController::class, 'book_info'])->name('book.info');


Route::get('/news', [HomeController::class, 'news_list'])->name('news.list');
Route::get('/news/{news_id}', [HomeController::class, 'news_info'])->name('news.info');


//Sobrecribimos el /dashboard que trae breeze
Route::get('/dashboard', fn () => redirect('/'))->name('dashboard');
