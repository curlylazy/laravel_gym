<?php

use Illuminate\Support\Facades\Route;

// controller admin
use App\Http\Controllers\aDashboard;
use App\Http\Controllers\aAdmin;
use App\Http\Controllers\aStaff;
use App\Http\Controllers\aAuth;

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