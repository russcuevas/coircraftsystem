<?php

use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\InventoryController;
use App\Http\Controllers\admin\OrdersController;
use App\Http\Controllers\admin\ReportsController;
use App\Http\Controllers\admin\StorefrontController;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
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

Route::get('/login', [AuthController::class, 'LoginPage'])->name('auth.login.page');
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
