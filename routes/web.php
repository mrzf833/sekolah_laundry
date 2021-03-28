<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminPaketController;
use App\Http\Controllers\Admin\AdminMemberController;
use App\Http\Controllers\Admin\AdminOutletController;
use App\Http\Controllers\Admin\AdminStatusLaporanController;
use App\Http\Controllers\Admin\AdminTransaksiController;
use App\Http\Controllers\Admin\AdminTransaksiDetailController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

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

// -------- prefix admin name = admin. ----------------------
Route::group(['middleware' => 'auth'], function(){
    Route::get('/', function () {
        $role = auth()->user()->role;
        if($role === 'admin'){
            return redirect()->route('admin.user.index');
        }
        
        return redirect()->route('login');
    });

    Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'] , function(){

        // ------------ prefix user; name = admin.user. -------------
        Route::group(['prefix' => 'user', 'as' => 'user.'], function(){
            Route::get('/', [AdminUserController::class, 'index'])->name('index');
            Route::get('/datatable', [AdminUserController::class, 'datatable'])->name('datatable');
            Route::post('/', [AdminUserController::class, 'store'])->name('store');
            Route::patch('/{id}/edit', [AdminUserController::class, 'edit'])->name('edit');
            Route::delete('/{id}/delete', [AdminUserController::class, 'destroy'])->name('destroy');
        });
    
        // ------------ prefix member; name = admin.member. -------------
        Route::group(['prefix' => 'member', 'as' => 'member.'], function(){
            Route::get('/', [AdminMemberController::class, 'index'])->name('index');
            Route::get('/datatable', [AdminMemberController::class, 'datatable'])->name('datatable');
            Route::post('/', [AdminMemberController::class, 'store'])->name('store');
            Route::patch('/{id}/edit', [AdminMemberController::class, 'edit'])->name('edit');
            Route::delete('/{id}/delete', [AdminMemberController::class, 'destroy'])->name('destroy');
        });
    
        // ------------ prefix outlet; name = admin.outlet. -------------
        Route::group(['prefix' => 'outlet', 'as' => 'outlet.'], function(){
            Route::get('/', [AdminOutletController::class, 'index'])->name('index');
            Route::get('/datatable', [AdminOutletController::class, 'datatable'])->name('datatable');
            Route::post('/', [AdminOutletController::class, 'store'])->name('store');
            Route::patch('/{id}/edit', [AdminOutletController::class, 'edit'])->name('edit');
            Route::delete('/{id}/delete', [AdminOutletController::class, 'destroy'])->name('destroy');
        });
    
        // ------------ prefix paket; name = paket.outlet. -------------
        Route::group(['prefix' => 'paket', 'as' => 'paket.'], function(){
            Route::get('/', [AdminPaketController::class, 'index'])->name('index');
            Route::get('/datatable', [AdminPaketController::class, 'datatable'])->name('datatable');
            Route::post('/', [AdminPaketController::class, 'store'])->name('store');
            Route::patch('/{id}/edit', [AdminPaketController::class, 'edit'])->name('edit');
            Route::delete('/{id}/delete', [AdminPaketController::class, 'destroy'])->name('destroy');
        });
    
        Route::group(['prefix' => 'transaksi', 'as' => 'transaksi.'], function(){
            Route::group(['prefix' => 'detail', 'as' => 'detail.'], function(){
                Route::get('/{transaksi_id}', [AdminTransaksiDetailController::class, 'index'])->name('index');
                Route::get('/{transaksi_id}/datatable', [AdminTransaksiDetailController::class, 'datatable'])->name('datatable');

                Route::patch('/{transaksi_id}/{detail_transaksi_id}/edit', [AdminTransaksiDetailController::class, 'edit'])->name('edit');
                Route::delete('/{transaksi_id}/{detail_transaksi_id}/delete', [AdminTransaksiDetailController::class, 'destroy'])->name('destroy');
            });

            Route::get('/', [AdminTransaksiController::class, 'index'])->name('index');
            Route::post('/', [AdminTransaksiController::class, 'store'])->name('store');
            Route::patch('/{id}/edit', [AdminTransaksiController::class, 'edit'])->name('edit');
            Route::delete('/{id}/delete', [AdminTransaksiController::class, 'destroy'])->name('destroy');
    
            Route::get('/search/paket', [AdminTransaksiController::class, 'search_paket'])->name('search.paket');
            Route::get('/{transaksi_id}/invoice/print', [AdminTransaksiController::class, 'invoice_print'])->name('invoice.print');
            Route::get('/{transaksi_id}/invoice/download', [AdminTransaksiController::class, 'invoice_pdf'])->name('invoice.pdf');
        });

        Route::group(['prefix' => 'status-laporan', 'as' => 'status.laporan.'], function(){
            Route::get('/all', [AdminStatusLaporanController::class, 'all'])->name('all');
            Route::get('/all/datatable', [AdminStatusLaporanController::class, 'all_datatable'])->name('all.datatable');

            Route::get('/baru', [AdminStatusLaporanController::class, 'baru'])->name('baru');
            Route::get('/baru/datatable', [AdminStatusLaporanController::class, 'baru_datatable'])->name('baru.datatable');

            Route::get('/proses', [AdminStatusLaporanController::class, 'proses'])->name('proses');
            Route::get('/proses/datatable', [AdminStatusLaporanController::class, 'proses_datatable'])->name('proses.datatable');

            Route::get('/selesai', [AdminStatusLaporanController::class, 'selesai'])->name('selesai');
            Route::get('/selesai/datatable', [AdminStatusLaporanController::class, 'selesai_datatable'])->name('selesai.datatable');

            Route::get('/diambil', [AdminStatusLaporanController::class, 'diambil'])->name('diambil');
            Route::get('/diambil/datatable', [AdminStatusLaporanController::class, 'diambil_datatable'])->name('diambil.datatable');
        });
    });
});

Route::get('login', [AuthenticatedSessionController::class,'create'])->name('login');
Route::post('login', [AuthenticatedSessionController::class,'store']);

Route::post('logout', [AuthenticatedSessionController::class,'destroy'])->name('logout');
// require __DIR__.'/auth.php';
