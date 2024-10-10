<?php

use App\Livewire\Auth\Login;
use App\Http\Middleware\RoleMiddleware;
use App\Livewire\Dashboard\Chart;
use App\Livewire\ProductSold\ProductSoldIndex;
use App\Livewire\Users\UserIndex;
use Illuminate\Support\Facades\Route;
use App\Livewire\History\HistoryIndex;
use App\Livewire\Product\ProductIndex;
use App\Livewire\Category\CategoryIndex;
use App\Livewire\Transaction\TransactionIndex;


Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return redirect('login');
    });
    Route::get('/login', Login::class)->name('login');
});

Route::middleware('auth')->group(function () {

});


Route::group(['middleware' => RoleMiddleware::class . ':admin'], function () {
    Route::get('/dashboard', Chart::class)->name('dashboard');
    Route::get('/user', UserIndex::class)->name('user');
    Route::get('/category', CategoryIndex::class)->name('category');
    Route::get('/product', ProductIndex::class)->name('product');
    Route::get('/transaction', TransactionIndex::class)->name('transaction');
    Route::get('/history', HistoryIndex::class)->name('history');
    Route::get('/product-sold', ProductSoldIndex::class)->name('product-sold');
});

Route::group(['middleware' => RoleMiddleware::class . ':cashier'], function () {
    Route::get('/transaction', TransactionIndex::class)->name('transaction');
});

Route::group(['middleware' => RoleMiddleware::class . ':staff'], function () {
    Route::get('/category', CategoryIndex::class)->name('category');
    Route::get('/product', ProductIndex::class)->name('product');
});
