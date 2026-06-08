<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\BookerMiddleware;
use App\Http\Controllers\HoldController;
use App\Http\Middleware\BookerAdminMiddleware;

// ==== General ====
Route::get('/admin',[AdminController::class, 'index'])->middleware(BookerAdminMiddleware::class)->name('admin.index');
Route::get('/', [HomeController::class, 'index'])->name('index');


// ==== Session ====
Route::post("/logout", [LoginController::class, 'logout'])->middleware('auth')->name('logout');
Route::get("/logout", [LoginController::class, 'logout'])->middleware('auth');

Route::get("/login", [LoginController::class, 'show_login_form'])->middleware('guest')->name('login');
Route::post("/login", [LoginController::class, 'authenticate'])->middleware('guest');

Route::get("/register", [LoginController::class, 'show_register_form'])->middleware('guest')->name('register');
Route::post("/register", [LoginController::class, 'register'])->middleware('guest');

// ==== Profile ====
Route::get("/profile", [UserController::class, 'show_profile'])->middleware('auth')->name('profile');
Route::put("/profile", [UserController::class, 'update_profile'])->middleware('auth')->name('profile.update');

// ===== Authors ====
Route::resource('/admin/authors', AuthorController::class)->middleware(BookerAdminMiddleware::class);

// ==== Categories ====
Route::resource('/admin/categories', CategoryController::class)->middleware(BookerAdminMiddleware::class);


// ==== Books ====
Route::get('/admin/books/archived', [BookController::class, 'archived'])->name('books.archived')->middleware(BookerAdminMiddleware::class);
Route::put('/admin/books/restore/{book}', [BookController::class, 'restore'])->name('books.restore')->middleware(BookerAdminMiddleware::class);
Route::resource('/admin/books', BookController::class)->middleware(BookerAdminMiddleware::class);
Route::get('/books', [HomeController::class, 'book_list'])->name('book.list');
Route::get('/books/search', [BookController::class, 'search'])->name('book.search');
Route::get('/books/{book_id}', [HomeController::class, 'book_info'])->name('book.info');

// ==== News ====
Route::resource('/admin/news', NewsController::class)->middleware(BookerAdminMiddleware::class);
Route::get('/news', [HomeController::class, 'news_list'])->name('news.list');
Route::get('/news/search', [NewsController::class, 'search'])->name('news.search');
Route::get('/news/{news_id}', [HomeController::class, 'news_info'])->name('news.info');


// ==== Loans ====
Route::get('/loan/new/{book}', [LoanController::class, 'form_new'])->name("loans.request")->middleware("auth");
Route::post('/loan/new/{book}', [LoanController::class, 'confirm_loan'])->name("loans.confirm")->middleware("auth");

Route::get('/loan/user/{user}', [LoanController::class, 'list_user_loans'])->name("loans.user")->middleware("auth");
Route::put('/admin/loan/restore/{loan}', [LoanController::class, 'restore'])->name("admin.loans.restore")->middleware(BookerAdminMiddleware::class);

Route::get('/admin/loan', [LoanController::class, 'list_loans'])->name("admin.loans")->middleware(BookerAdminMiddleware::class);
Route::get('/admin/ /user/{user}', [LoanController::class, 'list_user_loans'])->name("admin.loans.user")->middleware(BookerAdminMiddleware::class);
Route::get('/admin/loan/edit/{loan}', [LoanController::class, 'show_edit_form'])->name("admin.loans.edit")->middleware(BookerAdminMiddleware::class);
Route::put('/admin/loan/edit/{loan}', [LoanController::class, 'update_loan'])->name("admin.loans.update")->middleware(BookerAdminMiddleware::class);
Route::delete('/admin/loan/destroy/{loan}', [LoanController::class ,'destroy'])->name("admin.loans.destroy")->middleware(BookerAdminMiddleware::class);

// ==== Users ====
Route::put('/admin/users/restore/{user}', [UserController::class, 'restore'])->name('users.restore')->middleware(BookerAdminMiddleware::class);
Route::resource('/admin/users', UserController::class)->middleware(BookerAdminMiddleware::class);

// ==== Config ====
Route::get('/admin/config', [AdminController::class, 'show_config_form'])->name('admin.config.index')->middleware(AdminMiddleware::class);
Route::put('/admin/config', [AdminController::class, 'update_config'])->name('admin.config.update')->middleware(AdminMiddleware::class);

// ==== Holds ====
Route::post('/books/{book}/hold', [HoldController::class, 'toggle'])->name('books.hold')->middleware('auth');

// //Sobrecribimos el /dashboard que trae breeze
// // Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard')->middleware(AdminMiddleware::class);
