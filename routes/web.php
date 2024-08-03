<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\AuthController;
use App\Http\Controllers\Admin\Auth\CategoryController;
use App\Http\Controllers\Admin\Auth\TransactionController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::middleware('isLogin')->group(function () {
    Route::get('/', [AuthController::class, 'RegisterStore'])->name('login');
    Route::post('/user-register', [AuthController::class, 'RegisterCreate'])->name('user-register');
    Route::get('/login', [AuthController::class, 'loginForm'])->name('user-login');
    Route::post('admin-login', [AuthController::class, 'authuser'])->name('ck_login');
});
Route::middleware(['auth'])->get('dashboard', [AuthController::class, 'dashboard'])->name('admin.dashboard');
Route::middleware(['auth'])->get('logout-user', [AuthController::class, 'logoutUser'])->name('logout.user');
Route::middleware(['auth'])->group(function () {
    Route::get('category', [CategoryController::class, 'index'])->name('category.index');
    Route::get('category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('category/store', [CategoryController::class, 'store'])->name('category.store');
    Route::get('category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::post('category/update', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('category/{id}', [CategoryController::class, 'delete'])->name('category.delete');

    Route::get('transaction', [TransactionController::class, 'index'])->name('transaction.index');
    Route::get('transaction/create', [TransactionController::class, 'create'])->name('transaction.create');
    Route::post('transaction/store', [TransactionController::class, 'store'])->name('transaction.store');
    Route::get('transaction/edit/{id}', [TransactionController::class, 'edit'])->name('transaction.edit');
    Route::post('transaction/update', [TransactionController::class, 'update'])->name('transaction.update');
    Route::delete('transaction/{id}', [TransactionController::class, 'delete'])->name('transaction.delete');

    Route::get('monthly/report', [TransactionController::class, 'MonthlyReport'])->name('monthly.report');
    Route::get('monthly-report', [TransactionController::class, 'downloadReport'])->name('monthly-report');
    Route::get('recurring/transaction', [TransactionController::class, 'RecurringTransaction'])->name('recurring-transaction');
});
