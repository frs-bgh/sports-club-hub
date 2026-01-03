<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminUserController;

use App\Http\Controllers\PasswordResetController;

use App\Http\Controllers\NewsController;
use App\Http\Controllers\AdminNewsController;

use App\Http\Controllers\FaqController;
use App\Http\Controllers\AdminFaqCategoryController;
use App\Http\Controllers\AdminFaqQuestionController;

use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminContactMessageController;

/*
| public pages
*/
Route::get('/', [HomeController::class, 'index'])->name('home');

// members directory (public)
Route::get('/profiles', [ProfileController::class, 'index'])->name('profiles.index');

// public profile page (visible for everyone)
Route::get('/profiles/{user}', [ProfileController::class, 'show'])->name('profiles.show');

// news (public)
Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::get('/news/{newsItem}', [NewsController::class, 'show'])->name('news.show');

// faq (public)
Route::get('/faq', [FaqController::class, 'index'])->name('faq.index');

// contact (public)
Route::get('/contact', [ContactController::class, 'form'])->name('contact.form');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

/*
| auth pages (register / login / logout)
*/
Route::get('/register', [AuthController::class, 'create'])->name('register');
Route::post('/register', [AuthController::class, 'store'])->name('register.store');

Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.store');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
| password reset (forgot password) - only for guests
*/
Route::middleware('guest')->group(function () {
    Route::get('/forgot-password', [PasswordResetController::class, 'requestForm'])->name('password.request');
    Route::post('/forgot-password', [PasswordResetController::class, 'sendResetLink'])->name('password.email');

    Route::get('/reset-password/{token}', [PasswordResetController::class, 'resetForm'])->name('password.reset');
    Route::post('/reset-password', [PasswordResetController::class, 'reset'])->name('password.update');
});

/*
| pages only for logged in users
*/
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

/*
| admin pages
*/
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // users
    Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [AdminUserController::class, 'create'])->name('users.create');
    Route::post('/users', [AdminUserController::class, 'store'])->name('users.store');
    Route::post('/users/{user}/toggle-admin', [AdminUserController::class, 'toggleAdmin'])->name('users.toggleAdmin');
    Route::delete('/users/{user}', [AdminUserController::class, 'destroy'])->name('users.destroy');

    // news CRUD
    Route::resource('news', AdminNewsController::class)->except(['show']);

    // faq CRUD
    Route::resource('faq-categories', AdminFaqCategoryController::class)->except(['show']);
    Route::resource('faq-questions', AdminFaqQuestionController::class)->except(['show']);

    // contact messages (admin panel)
    Route::get('/contacts', [AdminContactMessageController::class, 'index'])->name('contacts.index');
    Route::get('/contacts/{contactMessage}', [AdminContactMessageController::class, 'show'])->name('contacts.show');
    Route::delete('/contacts/{contactMessage}', [AdminContactMessageController::class, 'destroy'])->name('contacts.destroy');
});
