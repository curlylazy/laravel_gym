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

// ajax
use App\Http\Controllers\fAjax;

// controller pelanggan
use App\Http\Controllers\fDashboard;

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

//  ================================= ADMIN ROUTE ===============================

Route::any('/admin', [aAuth::class, 'login']);

// Dashboard
Route::any('/admin/dashboard', [aDashboard::class, 'index']);

// Auth
Route::any('/admin/auth/login', [aAuth::class, 'login']);
Route::any('/admin/auth/profile', [aAuth::class, 'profile']);
Route::any('/admin/auth/actlogin', [aAuth::class, 'actlogin']);
Route::any('/admin/auth/actlogout', [aAuth::class, 'actlogout']);
Route::any('/admin/auth/actupdateprofile', [aAuth::class, 'actupdateprofile']);

// Staff
Route::any('/admin/staff/list', [aStaff::class, 'list']);
Route::any('/admin/staff/tambah', [aStaff::class, 'tambah']);
Route::any('/admin/staff/edit/{id}', [aStaff::class, 'edit']);
Route::any('/admin/staff/acttambah', [aStaff::class, 'acttambah']);
Route::any('/admin/staff/actedit', [aStaff::class, 'actedit']);
Route::any('/admin/staff/acthapus/{id}', [aStaff::class, 'acthapus']);

// Alat GYM
Route::any('/admin/alatgym/list', [aAlatGym::class, 'list']);
Route::any('/admin/alatgym/tambah', [aAlatGym::class, 'tambah']);
Route::any('/admin/alatgym/edit/{id}', [aAlatGym::class, 'edit']);
Route::any('/admin/alatgym/acttambah', [aAlatGym::class, 'acttambah']);
Route::any('/admin/alatgym/actedit', [aAlatGym::class, 'actedit']);
Route::any('/admin/alatgym/acthapus/{id}', [aAlatGym::class, 'acthapus']);

// Informasi
Route::any('/admin/informasi/list', [aInformasi::class, 'list']);
Route::any('/admin/informasi/tambah', [aInformasi::class, 'tambah']);
Route::any('/admin/informasi/edit/{id}', [aInformasi::class, 'edit']);
Route::any('/admin/informasi/acttambah', [aInformasi::class, 'acttambah']);
Route::any('/admin/informasi/actedit', [aInformasi::class, 'actedit']);
Route::any('/admin/informasi/acthapus/{id}', [aInformasi::class, 'acthapus']);

// Anggota
Route::any('/admin/anggota/list', [aAnggota::class, 'list']);
Route::any('/admin/anggota/tambah', [aAnggota::class, 'tambah']);
Route::any('/admin/anggota/edit/{id}', [aAnggota::class, 'edit']);
Route::any('/admin/anggota/acttambah', [aAnggota::class, 'acttambah']);
Route::any('/admin/anggota/actedit', [aAnggota::class, 'actedit']);
Route::any('/admin/anggota/acthapus/{id}', [aAnggota::class, 'acthapus']);