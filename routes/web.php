<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\Master\BahanController;
use App\Http\Controllers\Ajax\AjaxDataController;
use App\Http\Controllers\Master\ProdukController;
use App\Http\Controllers\Stok\StokAwalController;
use App\Http\Controllers\Keuangan\SaldoController;
use App\Http\Controllers\Master\PenggunaController;
use App\Http\Controllers\Master\SupplierController;
use App\Http\Controllers\Transaksi\PembelianController;
use App\Http\Controllers\Transaksi\PemesananController;
use App\Http\Controllers\Transaksi\PenjualanController;
use App\Http\Controllers\Keuangan\PengeluaranController;
use App\Http\Controllers\Master\MetodePembayaranController;
use App\Http\Controllers\Transaksi\DetailPesananController;
use App\Http\Controllers\Transaksi\DetailPenjualanController;

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

Auth::routes();

Route::group(['prefix' => 'master', 'middleware' => ['role:admin']], function () {
    Route::resource('users', PenggunaController::class);
    Route::resource('produk', ProdukController::class);
    Route::resource('bahan', BahanController::class);
    Route::resource('metode-bayar', MetodePembayaranController::class);
    Route::resource('supplier', SupplierController::class);
});
Route::group(['prefix' => 'keuangan', 'middleware' => ['role:admin']], function () {
    Route::resource('pengeluaran', PengeluaranController::class);
});
Route::group(['prefix' => 'transaksi', 'middleware' => ['role:admin']], function () {
    // Pre Order
    Route::get('/preorder/buat', [PemesananController::class, 'create'])->name('pesanan.baru');
    Route::resource('preorder', PemesananController::class)->except('create');
    Route::get('item-preorder/{id}/data', [DetailPesananController::class, 'data_detail'])->name('item-pesanan.data');
    Route::resource('item-preorder', DetailPesananController::class);
    // Penjualan
    Route::get('/penjualan/baru', [PenjualanController::class, 'create'])->name('penjualan.baru');
    Route::resource('penjualan', PenjualanController::class)->except('create');
    Route::get('item-penjualan/{id}/data', [DetailPenjualanController::class, 'data_detail'])->name('item-penjualan.data');
    Route::resource('item-penjualan', DetailPenjualanController::class);

    Route::resource('pengeluaran', PengeluaranController::class);
    Route::resource('stok', StokAwalController::class);
    Route::resource('saldo', SaldoController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');

    Route::get('/report/harian', [ReportController::class, 'reportHarian'])->name('report.harian');
    Route::get('/report/bulanan', [ReportController::class, 'reportBulanan'])->name('report.bulanan');
    Route::get('/report', [ReportController::class, 'showReportPeriode'])->name('report.view');
    Route::post('/report', [ReportController::class, 'printReportPeriode'])->name('report.print');
});


// APIDATA
Route::get('ajax', [AjaxDataController::class, 'data_produk'])->name('data.produk');
Route::get('stok.ajax', [AjaxDataController::class, 'stok'])->name('data.stok');
