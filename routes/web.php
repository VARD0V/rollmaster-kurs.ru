<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Models\Categories;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;


Route::get('/main', function () {
    return view('main');
})->name('main');

// Регистрация
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Авторизация
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Главная
Route::get('/main', [ProductController::class, 'index'])->name('main');

// Категории
Route::get('/categories', [CategoryController::class, 'index'])->name('category.index');;
Route::get('/categories/{id}', [CategoryController::class, 'show'])->name('category.show');
Route::get('/products/{id}', [ProductController::class, 'show']);


Route::get('/admin', [AdminController::class, 'showAdminCapability'])->name('admin');
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/products', [AdminController::class, 'products'])->name('admin.products');
    Route::get('/admin/categories', [AdminController::class, 'categories'])->name('admin.categories');

    Route::get('/admin/products/create',[ProductController::class, 'showFormCreateProduct'])->name('product.create');
    Route::post('/admin/products/create', [ProductController::class, 'create']);

    Route::get('/admin/categories/create',[CategoryController::class, 'showFormCreateCategory'])->name('category.create');
    Route::post('/admin/categories/create', [CategoryController::class, 'create']);
});
