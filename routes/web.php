<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\AdminController;

// Trang chủ
Route::get('/', [HomeController::class, 'index'])->name('home');

// Trang Menu
Route::get('/menu', [MenuController::class, 'index'])->name('menu');
Route::get('/menu/{id}', [MenuController::class, 'show'])->name('menu.item');

// Trang About
Route::get('/about', [AboutController::class, 'index'])->name('about');

// Trang Contact
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');

// Trang Products
Route::get('/products', [ProductController::class, 'index'])->name('products');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest');
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register')->middleware('guest');
Route::post('/register', [AuthController::class, 'register'])->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Customer Routes
Route::middleware(['auth', 'role:customer'])->group(function () {
    Route::get('/cart', [App\Http\Controllers\Customer\CartController::class, 'index'])->name('cart');
    Route::post('/cart/add', [App\Http\Controllers\Customer\CartController::class, 'add'])->name('cart.add');
    Route::delete('/cart/remove/{id}', [App\Http\Controllers\Customer\CartController::class, 'remove'])->name('cart.remove');
    Route::put('/cart/update/{id}', [App\Http\Controllers\Customer\CartController::class, 'update'])->name('cart.update');
    
    Route::get('/checkout', [App\Http\Controllers\Customer\CheckoutController::class, 'index'])->name('checkout');
    Route::post('/checkout/process', [App\Http\Controllers\Customer\CheckoutController::class, 'process'])->name('checkout.process');
    
    Route::get('/payment', [App\Http\Controllers\Customer\PaymentController::class, 'index'])->name('payment');
    Route::post('/payment/process', [App\Http\Controllers\Customer\PaymentController::class, 'process'])->name('payment.process');
    
    Route::get('/orders', [App\Http\Controllers\Customer\OrderController::class, 'index'])->name('customer.orders');
    Route::get('/orders/{id}', [App\Http\Controllers\Customer\OrderController::class, 'show'])->name('customer.orders.show');
    
    Route::get('/profile', [App\Http\Controllers\Customer\ProfileController::class, 'index'])->name('profile');
    Route::put('/profile/update', [App\Http\Controllers\Customer\ProfileController::class, 'update'])->name('profile.update');
});

// Admin Routes
Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');
    
    // Products Management
    Route::get('/products', [App\Http\Controllers\Admin\ProductController::class, 'index'])->name('admin.products');
    Route::get('/products/create', [App\Http\Controllers\Admin\ProductController::class, 'create'])->name('admin.products.create');
    Route::post('/products', [App\Http\Controllers\Admin\ProductController::class, 'store'])->name('admin.products.store');
    Route::get('/products/{id}/edit', [App\Http\Controllers\Admin\ProductController::class, 'edit'])->name('admin.products.edit');
    Route::put('/products/{id}', [App\Http\Controllers\Admin\ProductController::class, 'update'])->name('admin.products.update');
    Route::delete('/products/{id}', [App\Http\Controllers\Admin\ProductController::class, 'destroy'])->name('admin.products.destroy');
    
    // Categories Management
    Route::get('/categories', [App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('admin.categories');
    Route::get('/categories/create', [App\Http\Controllers\Admin\CategoryController::class, 'create'])->name('admin.categories.create');
    Route::post('/categories', [App\Http\Controllers\Admin\CategoryController::class, 'store'])->name('admin.categories.store');
    Route::get('/categories/{id}/edit', [App\Http\Controllers\Admin\CategoryController::class, 'edit'])->name('admin.categories.edit');
    Route::put('/categories/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'update'])->name('admin.categories.update');
    Route::delete('/categories/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'destroy'])->name('admin.categories.destroy');
    
    // Orders Management
    Route::get('/orders', [App\Http\Controllers\Admin\OrderController::class, 'index'])->name('admin.orders');
    Route::get('/orders/{id}', [App\Http\Controllers\Admin\OrderController::class, 'show'])->name('admin.orders.show');
    Route::put('/orders/{id}/status', [App\Http\Controllers\Admin\OrderController::class, 'updateStatus'])->name('admin.orders.update.status');
    
    // Users Management
    Route::get('/users', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('admin.users');
    Route::get('/users/{id}/edit', [App\Http\Controllers\Admin\UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/users/{id}', [App\Http\Controllers\Admin\UserController::class, 'update'])->name('admin.users.update');
    
    // Reports & Analytics
    Route::get('/reports/sales', [App\Http\Controllers\Admin\ReportController::class, 'sales'])->name('admin.reports.sales');
    Route::get('/reports/products', [App\Http\Controllers\Admin\ReportController::class, 'products'])->name('admin.reports.products');
});
