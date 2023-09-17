<?php

use Illuminate\Support\Facades\Artisan;
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

Route::get('/redirect-login', function () {
    return redirect('login');
})->name('login');

Route::get('artisan/migrate', function() {
    Artisan::call('migrate:fresh', [
        '--seed',
        '--force' => true,
    ]);
});

Route::get('artisan/storage', function() {
    Artisan::call('storage:link');
});

Route::middleware(['auth'])->group(function () {
    Route::view('/atcm/waiter', 'atcm.home')->name('waiter.home');
    Route::view('/atcm/waiter/new-order', 'atcm.new-order')->name('waiter.new-order');
    Route::view('/atcm/waiter/cards', 'atcm.cards')->name('waiter.cards');
    Route::view('/atcm/waiter/tables', 'atcm.tables')->name('waiter.tables');
    Route::view('/atcm/waiter/orders-concluded', 'atcm.orders-concluded')->name('waiter.orders.concluded');
});