<?php

use Illuminate\Support\Facades\Route;

// controller admin
use App\Http\Controllers\aDashboard;
use App\Http\Controllers\aAdmin;
use App\Http\Controllers\aStaff;
use App\Http\Controllers\aAlatGym;
use App\Http\Controllers\aInformasi;
use App\Http\Controllers\aAuth;
use App\Http\Controllers\aAnggota;
use App\Http\Controllers\aKonfirmasi;
use App\Http\Controllers\aKunjungan;
use App\Http\Controllers\aLaporan;

// ajax
use App\Http\Controllers\fAjax;

// controller pelanggan
use App\Http\Controllers\fDashboard;
use App\Http\Controllers\fAuth;
use App\Http\Controllers\fPembayaran;
use App\Http\Controllers\fInformasi;
use App\Http\Controllers\fAlatGym;
use App\Http\Controllers\fKunjungan;

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

Route::get('gambar/{filename}', function ($filename)
{
	$path = public_path('uploads/pic/'.$filename);

    if(!File::exists($path))
        $path = public_path('uploads/pic/noimage.jpg');

    if($filename == "" || $filename == null)
        $path = public_path('uploads/pic/noimage.jpg');

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;

});

// AJAX
Route::post('/ajax/pengiriman/getongkir',  [fAjax::class, 'getongkir']);

//  ================================= PELANGGAN ROUTE ===============================

Route::any('/', [fDashboard::class, 'index']);
Route::any('/dashboard', [fDashboard::class, 'index']);

// auth
Route::any('/auth/registrasi', [fAuth::class, 'registrasi']);
Route::any('/auth/login', [fAuth::class, 'login']);
Route::any('/auth/profile', [fAuth::class, 'profile']);
Route::any('/auth/kartuanggota', [fAuth::class, 'kartuanggota']);
Route::any('/auth/revisi/{id}', [fAuth::class, 'revisi']);
Route::any('/auth/logout', [fAuth::class, 'actlogout']);
Route::any('/auth/actlogin', [fAuth::class, 'actlogin']);
Route::any('/auth/actregistrasi', [fAuth::class, 'actregistrasi']);
Route::any('/auth/actrevisi', [fAuth::class, 'actrevisi']);
Route::any('/auth/actupdateprofile', [fAuth::class, 'actupdateprofile']);

// pembayaran
Route::any('/pembayaran/list', [fPembayaran::class, 'list']);
Route::any('/pembayaran/tambah', [fPembayaran::class, 'tambah']);
Route::any('/pembayaran/edit/{id}', [fPembayaran::class, 'edit']);
Route::any('/pembayaran/acttambah', [fPembayaran::class, 'acttambah']);
Route::any('/pembayaran/actedit', [fPembayaran::class, 'actedit']);

// informasi
Route::any('/informasi/list', [fInformasi::class, 'list']);
Route::any('/informasi/detail/{id}', [fInformasi::class, 'detail']);

// alat gym
Route::any('/alatgym/list', [fAlatGym::class, 'list']);
Route::any('/alatgym/detail/{id}', [fAlatGym::class, 'detail']);

// kunjungan
Route::any('/kunjungan/actsetfilter', [fKunjungan::class, 'actsetfilter']);
Route::any('/kunjungan/list', [fKunjungan::class, 'list']);

//  ================================= ADMIN ROUTE ===============================

Route::any('/admin', [aAuth::class, 'login']);

// Dashboard
Route::any('/admin/dashboard', [aDashboard::class, 'index'])->middleware('ceklogin');

// Auth
Route::any('/admin/auth/login', [aAuth::class, 'login']);
Route::any('/admin/auth/profile', [aAuth::class, 'profile'])->middleware('ceklogin');
Route::any('/admin/auth/actlogin', [aAuth::class, 'actlogin']);
Route::any('/admin/auth/actlogout', [aAuth::class, 'actlogout']);
Route::any('/admin/auth/actupdateprofile', [aAuth::class, 'actupdateprofile'])->middleware('ceklogin');

// Staff
Route::any('/admin/staff/list', [aStaff::class, 'list'])->middleware('ceklogin');
Route::any('/admin/staff/tambah', [aStaff::class, 'tambah'])->middleware('ceklogin');
Route::any('/admin/staff/edit/{id}', [aStaff::class, 'edit'])->middleware('ceklogin');
Route::any('/admin/staff/acttambah', [aStaff::class, 'acttambah'])->middleware('ceklogin');
Route::any('/admin/staff/actedit', [aStaff::class, 'actedit'])->middleware('ceklogin');
Route::any('/admin/staff/acthapus/{id}', [aStaff::class, 'acthapus'])->middleware('ceklogin');

// Alat GYM
Route::any('/admin/alatgym/list', [aAlatGym::class, 'list'])->middleware('ceklogin');
Route::any('/admin/alatgym/tambah', [aAlatGym::class, 'tambah'])->middleware('ceklogin');
Route::any('/admin/alatgym/edit/{id}', [aAlatGym::class, 'edit'])->middleware('ceklogin');
Route::any('/admin/alatgym/acttambah', [aAlatGym::class, 'acttambah'])->middleware('ceklogin');
Route::any('/admin/alatgym/actedit', [aAlatGym::class, 'actedit'])->middleware('ceklogin');
Route::any('/admin/alatgym/acthapus/{id}', [aAlatGym::class, 'acthapus'])->middleware('ceklogin');

// Informasi
Route::any('/admin/informasi/list', [aInformasi::class, 'list'])->middleware('ceklogin');
Route::any('/admin/informasi/tambah', [aInformasi::class, 'tambah'])->middleware('ceklogin');
Route::any('/admin/informasi/edit/{id}', [aInformasi::class, 'edit'])->middleware('ceklogin');
Route::any('/admin/informasi/acttambah', [aInformasi::class, 'acttambah'])->middleware('ceklogin');
Route::any('/admin/informasi/actedit', [aInformasi::class, 'actedit'])->middleware('ceklogin');
Route::any('/admin/informasi/acthapus/{id}', [aInformasi::class, 'acthapus'])->middleware('ceklogin');

// Konfirmasi
Route::any('/admin/konfirmasi/list', [aKonfirmasi::class, 'list'])->middleware('ceklogin');
Route::any('/admin/konfirmasi/tambah', [aKonfirmasi::class, 'tambah'])->middleware('ceklogin');
Route::any('/admin/konfirmasi/detail/{id}', [aKonfirmasi::class, 'detail'])->middleware('ceklogin');
Route::any('/admin/konfirmasi/acttambah', [aKonfirmasi::class, 'acttambah'])->middleware('ceklogin');
Route::any('/admin/konfirmasi/actedit', [aKonfirmasi::class, 'actedit'])->middleware('ceklogin');
Route::any('/admin/konfirmasi/acthapus/{id}', [aKonfirmasi::class, 'acthapus'])->middleware('ceklogin');

// Anggota
Route::any('/admin/anggota/list', [aAnggota::class, 'list'])->middleware('ceklogin');
Route::any('/admin/anggota/verifikasi', [aAnggota::class, 'verifikasi'])->middleware('ceklogin');
Route::any('/admin/anggota/verifikasi/detail/{id}', [aAnggota::class, 'verifikasidetail'])->middleware('ceklogin');
Route::any('/admin/anggota/informasi', [aAnggota::class, 'informasi'])->middleware('ceklogin');
Route::any('/admin/anggota/tambah', [aAnggota::class, 'tambah'])->middleware('ceklogin');
Route::any('/admin/anggota/edit/{id}', [aAnggota::class, 'edit'])->middleware('ceklogin');
Route::any('/admin/anggota/detail/{id}', [aAnggota::class, 'detail'])->middleware('ceklogin');
Route::any('/admin/anggota/acttambah', [aAnggota::class, 'acttambah'])->middleware('ceklogin');
Route::any('/admin/anggota/actedit', [aAnggota::class, 'actedit'])->middleware('ceklogin');
Route::any('/admin/anggota/actverifikasi', [aAnggota::class, 'actverifikasi'])->middleware('ceklogin');
Route::any('/admin/anggota/acthapus/{id}', [aAnggota::class, 'acthapus'])->middleware('ceklogin');

// Kunjungan
Route::any('/admin/kunjungan/list', [aKunjungan::class, 'list'])->middleware('ceklogin');
Route::any('/admin/kunjungan/tambah', [aKunjungan::class, 'tambah'])->middleware('ceklogin');
Route::any('/admin/kunjungan/acttambah', [aKunjungan::class, 'acttambah'])->middleware('ceklogin');
Route::any('/admin/kunjungan/acthapus/{id}', [aKunjungan::class, 'acthapus'])->middleware('ceklogin');

// Laporan
Route::any('/admin/laporan/anggota', [aLaporan::class, 'anggota'])->middleware('ceklogin');
Route::any('/admin/laporan/kunjungan', [aLaporan::class, 'kunjungan'])->middleware('ceklogin');
Route::any('/admin/laporan/cetak/anggota', [aLaporan::class, 'cetak_anggota'])->middleware('ceklogin');
Route::any('/admin/laporan/cetak/kunjungan', [aLaporan::class, 'cetak_kunjungan'])->middleware('ceklogin');