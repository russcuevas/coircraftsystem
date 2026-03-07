<?php

use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\InventoryController;
use App\Http\Controllers\admin\OrdersController;
use App\Http\Controllers\admin\ReportsController;
use App\Http\Controllers\admin\StorefrontController;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CartCountsController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', [HomeController::class, 'HomePage'])->name('home.page');
Route::get('/shop', [ShopController::class, 'ShopPage'])->name('shop.page');
Route::get('/shop-search', [ShopController::class, 'ProductSearch']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/transactions', [TransactionController::class, 'MyTransactionPage'])->name('transactions.page');

    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update/{product}', [CartController::class, 'update'])->name('cart.update');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/remove/{cartItem}', [CartController::class, 'remove'])->name('cart.remove');
    Route::get('/cart-count', [CartCountsController::class, 'count'])->name('cart.count');

    Route::get('/checkout', [CheckoutController::class, 'CheckoutPage'])->name('checkout.page');
    Route::post('/checkout/place', [CheckoutController::class, 'CheckoutRequest'])->name('checkout.request');
Route::post('/checkout/profile/update', [CheckoutController::class, 'update'])
    ->name('checkout.profile.update');
    });


Route::get('/login', [AuthController::class, 'LoginPage'])->name('auth.login.page');
Route::post('/login/request', [AuthController::class, 'LoginRequest'])->name('auth.login.request');
Route::post('/logout', [AuthController::class, 'Logout'])->name('auth.logout');

Route::get('/register', [AuthController::class, 'RegisterPage'])->name('auth.regsiter.page');


// ADMIN
Route::get('/admin/login', [AuthController::class, 'AdminLoginPage'])->name('auth.admin.login.page');

Route::get('/admin/dashboard', [DashboardController::class, 'DashboardPage'])->name('admin.dashboard.page');
Route::get('/admin/storefront', [StorefrontController::class, 'StorefrontPage'])->name('admin.storefront.page');
Route::post('admin/storefront/update-features', [StorefrontController::class, 'UpdateProductFeatures'])->name('admin.storefront.update_features');
Route::delete('/admin/storefront/delete-product/{id}', [StorefrontController::class, 'DeleteProductFeature'])->name('admin.storefront.delete_product');


Route::get('/admin/inventory', [InventoryController::class, 'InventoryPage'])->name('admin.inventory.page');
Route::post('/admin/inventory/add-product', [InventoryController::class, 'AddProduct'])->name('admin.inventory.add.product');
Route::post('/admin/inventory/update/{id}', [InventoryController::class, 'UpdateProduct'])->name('admin.inventory.update');
Route::delete('/admin/inventory/delete/{id}', [InventoryController::class, 'DeleteProduct'])->name('admin.inventory.delete');

Route::get('/admin/reports', [ReportsController::class, 'ReportsPage'])->name('admin.reports.page');
Route::get('/admin/orders', [OrdersController::class, 'OrdersPage'])->name('admin.orders.page');
