<?php

use App\Models\Pemakaian;
use App\DataTables\RuanganDataTable;
use Illuminate\Support\Facades\Route;
use App\DataTables\Barang\AlatDataTable;
use App\Http\Controllers\AlatController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\DataTables\Barang\BahanDataTable;
use App\Http\Controllers\BahanController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\PemakaianController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PeminjamanController;

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

Route::get('/', function (RuanganDataTable $table) {
    // return view('welcome');
    return $table->render('dashboard');
})->name('dashboard');
Route::get('/ruangan/{id?}', [HomeController::class, 'showruangan'])->name('dashboard.ruangan');
Route::get('/ruangan/{id?}/alat', [HomeController::class, 'showalat'])->name('dashboard.ruangan.alat');
Route::get('/ruangan/{id?}/bahan', [HomeController::class, 'showbahan'])->name('dashboard.ruangan.bahan');

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'guest'], function() {
    Route::get('/admin/login', [LoginController::class, 'login'])->name('login');
    Route::post('/admin/login', [LoginController::class, 'store'])->name('login.store');
});

Route::group(['middleware' => 'auth', 'as' => 'admin.', 'prefix' => 'admin'], function() {
    Route::resource('alat', AlatController::class)->names('alat');
    Route::resource('bahan', BahanController::class)->names('bahan');
    Route::resource('ruangan', RuanganController::class)->names('ruangan');

    Route::get('home', [HomeController::class, 'index'])->name('home');
    Route::resource('laporan', LaporanController::class)->names('laporan');
    Route::get('profile', [HomeController::class, 'profile'])->name('profile');

    Route::get('ajax/getuser/{id?}', [UserController::class, 'getUser'])->name('ajax.getUser');
    Route::get('ajax/getbahan/{id?}', [BahanController::class, 'getBahan'])->name('ajax.getBahan');
    Route::get('ajax/getalat/{id?}', [AlatController::class, 'getAlat'])->name('ajax.getAlat');
    Route::get('ajax/getalat-by-ruangan/{id?}', [AlatController::class, 'getAlatRuangan'])->name('ajax.getAlatRuangan');
    Route::get('ajax/getbahan-by-ruangan/{id?}', [BahanController::class, 'getBahanRuangan'])->name('ajax.getBahanRuangan');
    Route::get('ajax/getruanga/{id?}', [RuanganController::class, 'getRuangan'])->name('ajax.getRuangan');

    Route::resource('peminjaman', PeminjamanController::class)->names('peminjaman');
    Route::resource('pemakaian', PemakaianController::class)->names('pemakaian');
});

Route::group(['middleware' => 'auth'], function() {
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});
