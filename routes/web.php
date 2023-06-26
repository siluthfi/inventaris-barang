<?php

use App\Http\Controllers\AlatController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BahanController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LaporanController;
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

Route::get('/', function () {
    // return view('welcome');
    return view('dashboard');
});

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'guest'], function() {
    Route::get('/admin/login', [LoginController::class, 'login'])->name('login');
    Route::post('/admin/login', [LoginController::class, 'store'])->name('login.store');
});

Route::group(['middleware' => 'auth', 'as' => 'admin.', 'prefix' => 'admin'], function() {
    Route::resource('alat', AlatController::class)->names('alat');
    Route::resource('bahan', BahanController::class)->names('bahan');

    Route::get('home', [HomeController::class, 'index'])->name('home');
    Route::resource('laporan', LaporanController::class)->names('laporan');
    Route::get('profile', [HomeController::class, 'profile'])->name('profile');
});

Route::group(['middleware' => 'auth'], function() {
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});
