<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NewsController;

use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\BookerMiddleware;


// ==== General ====
Route::get('/admin',[AdminController::class, 'index'])->middleware(AdminMiddleware::class)->name('admin.index');
Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/about_us', [HomeController::class, 'about'])->name('about.library');


// ==== Session ====
Route::post("/logout", [LoginController::class, 'logout'])->middleware('auth')->name('logout');
Route::get("/logout", [LoginController::class, 'logout'])->middleware('auth');

Route::get("/login", [LoginController::class, 'show_login_form'])->middleware('guest')->name('login');
Route::post("/login", [LoginController::class, 'authenticate'])->middleware('guest');

Route::get("/register", [LoginController::class, 'show_register_form'])->middleware('guest')->name('register');
Route::post("/register", [LoginController::class, 'register'])->middleware('guest');


// ===== Authors ====
Route::resource('/admin/authors', AuthorController::class)->middleware(BookerMiddleware::class);


// ==== BOOKS ====
Route::resource('/admin/books', BookController::class)->middleware(BookerMiddleware::class);
Route::get('/books', [HomeController::class, 'book_list'])->name('book.list');
Route::get('/books/{book_id}', [HomeController::class, 'book_info'])->name('book.info');


// ==== NEWS ====
Route::resource('/admin/news', NewsController::class)->middleware(BookerMiddleware::class);
Route::get('/news', [HomeController::class, 'news_list'])->name('news.list');
Route::get('/news/{news_id}', [HomeController::class, 'news_info'])->name('news.info');


// ==== LOANS ====
Route::get('/loan/new/{book}', [LoanController::class, 'form_new'])->name("loans.request")->middleware("auth");
Route::post('/loan/new/{book}', [LoanController::class, 'confirm_loan'])->name("loans.confirm")->middleware("auth");

Route::get('/loan/user/{user}', [LoanController::class, 'list_user_loans'])->name("loans.user")->middleware("auth");

Route::get('/admin/loan', [LoanController::class, 'list_loans'])->name("admin.loans")->middleware(AdminMiddleware::class);
Route::get('/admin/loan/user/{user}', [LoanController::class, 'list_user_loans'])->name("admin.loans.user")->middleware(AdminMiddleware::class);
Route::get('/admin/loan/edit/{loan}', [LoanController::class, 'show_edit_form'])->name("admin.loans.edit")->middleware(AdminMiddleware::class);
Route::put('/admin/loan/edit/{loan}', [LoanController::class, 'update_loan'])->name("admin.loans.update")->middleware(AdminMiddleware::class);
Route::delete('/admin/loan/destroy/{loan}', [LoanController::class ,'destroy'])->name("admin.loans.destroy")->middleware(AdminMiddleware::class);

// //Sobrecribimos el /dashboard que trae breeze
// // Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard')->middleware(AdminMiddleware::class);
