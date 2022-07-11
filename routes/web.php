<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', App\Http\Livewire\Landing\Index::class)->name('index');

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified'])->group(function () {

    Route::prefix('dashboard')->group( function() {

        Route::get('/', App\Http\Livewire\Dashboard\Index::class)->name('dashboard.index');

        Route::middleware(['checkRole'])->group(function() {
            Route::prefix('product')->group(function() {
                Route::get('/', App\Http\Livewire\Product\Index::class)->name('product.index');
                Route::get('/create', App\Http\Livewire\Product\Create::class)->name('product.create');
                Route::get('/edit/{id}', App\Http\Livewire\Product\Update::class)->name('product.update');
            });
        });

        Route::prefix('transaction')->group(function() {
            Route::get('/', App\Http\Livewire\Transaction\Index::class)->name('transaction.index');
            Route::get('/create', App\Http\Livewire\Transaction\Create::class)->name('transaction.create');
            Route::get('/edit/{id}', App\Http\Livewire\Transaction\Update::class)->name('transaction.update');
        });

    });
});
