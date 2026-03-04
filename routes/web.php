<?php

use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\InventoryController;
use App\Http\Controllers\admin\OrdersController;
use App\Http\Controllers\admin\ReportsController;
use App\Http\Controllers\admin\StorefrontController;
use App\Http\Controllers\auth\AuthController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'LoginPage'])->name('auth.login.page');
Route::get('/register', [AuthController::class, 'RegisterPage'])->name('auth.regsiter.page');


// ADMIN
Route::get('/admin/login', [AuthController::class, 'AdminLoginPage'])->name('auth.admin.login.page');

Route::get('/admin/dashboard', [DashboardController::class, 'DashboardPage'])->name('admin.dashboard.page');
Route::get('/admin/storefront', [StorefrontController::class, 'StorefrontPage'])->name('admin.storefront.page');
Route::get('/admin/inventory', [InventoryController::class, 'InventoryPage'])->name('admin.inventory.page');
Route::get('/admin/reports', [ReportsController::class, 'ReportsPage'])->name('admin.reports.page');
Route::get('/admin/orders', [OrdersController::class, 'OrdersPage'])->name('admin.orders.page');
