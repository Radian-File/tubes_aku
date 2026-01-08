<?php
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DashboardControllerr;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
  return view('landing');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login.authenticate');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'store'])->name('register.store');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware(['auth'])->group(function () {
  Route::middleware(['is_admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/products', [ProductController::class, 'index'])->name('admin.products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('admin.products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('admin.products.store');
    Route::get('/products/{product}', [ProductController::class, 'show'])->name('admin.products.show');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('admin.products.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('admin.products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('admin.products.destroy');
    Route::get('/orders', [OrderController::class, 'index'])->name('admin.orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('admin.orders.show');
    Route::put('/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('admin.orders.updateStatus');
  });

  Route::middleware('is_user')->prefix('user')->group(function () {
    Route::get('/dashboard', [DashboardControllerr::class, 'index'])->name('user.dashboard');

    Route::get('/products/{product}', [ProductController::class, 'show'])->name('user.products.show');
    Route::get('/products/{product}/buy', [ProductController::class, 'buy'])->name('user.products.buy');
    Route::post('/orders', [ProductController::class, 'storeOrder'])->name('user.orders.store');
    Route::get('/riwayat', [ProductController::class, 'riwayat'])->name('user.riwayat');
    Route::get('/orders/{order}', [ProductController::class, 'showOrder'])->name('user.orders.show');
    Route::put('/orders/{order}/complete', [ProductController::class, 'completeOrder'])->name('user.orders.complete');
  });
});
