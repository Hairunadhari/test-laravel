<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CutiController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PegawaiController;

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

Route::get('/', function () {
    return view('login');
});
Route::post('/login/submit', [AuthController::class,'submit']);

Route::middleware(['admin'])->group(function () {
Route::get('/logout', [AuthController::class,'logout']);

Route::get('/admin', [AdminController::class,'index']);
Route::post('/admin/submit', [AdminController::class,'submit']);
Route::get('/admin/edit/{id}', [AdminController::class,'edit']);
Route::put('/admin/update/{id}', [AdminController::class,'update']);
Route::delete('/admin/delete/{id}', [AdminController::class,'delete']);

Route::get('/pegawai', [PegawaiController::class,'index']);
Route::post('/pegawai/submit', [PegawaiController::class,'submit']);
Route::get('/pegawai/edit/{id}', [PegawaiController::class,'edit']);
Route::put('/pegawai/update/{id}', [PegawaiController::class,'update']);
Route::delete('/pegawai/delete/{id}', [PegawaiController::class,'delete']);

Route::get('/cuti', [CutiController::class,'index']);
Route::post('/cuti/submit', [CutiController::class,'submit']);
Route::get('/cuti/edit/{id}', [CutiController::class,'edit']);
Route::put('/cuti/update/{id}', [CutiController::class,'update']);
Route::delete('/cuti/delete/{id}', [CutiController::class,'delete']);
});
