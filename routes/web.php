<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboarController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\createPresensi;

Route::middleware(['guest:karyawan'])->group(function() {
    Route::get('/', function () {
        return view('auth.auth');
    })->name('login');
    Route::post("proseslogin", [AuthController::class, 'login']);

});

Route::middleware(['auth:karyawan'])->group(function() {
    Route::get("/dashboard", [DashboarController::class, 'index']);
    Route::get('proseslogout', [AuthController::class, 'proseslogout']);
    // presensi
    Route::get('create', [createPresensi::class, 'create']);
    Route::post('storage', [createPresensi::class, 'storage']);
});




