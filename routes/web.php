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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('artisan/migrate', function() {
    Artisan::call('migrate:fresh', [
        '--seed',
        '--force' => true,
    ]);
});

Route::get('artisan/storage', function() {
    Artisan::call('storage:link', [
        '--force' => true
    ]);
});
