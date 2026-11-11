<?php

use App\Http\Controllers\Dashboardcontroller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PelangganController;

Route::get('dashboard', [Dashboardcontroller:: class, 'index'])->name('dashboard');
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/pelanggan', [PelangganController::class, 'index'])->name('pelanggan.index');
route::get('/pelanggan/create', [PelangganController::class, 'create'])->name('pelanggan.create');
route::post('/pelanggan', [PelangganController::class, 'store'])->name('pelanggan.store');
route::get('/pelanggan/{id}/edit', [PelangganController::class, 'edit'])->name('pelanggan.edit');
route::put('/pelanggan/{id}', [PelangganController::class, 'update'])->name('pelanggan.update');
route::delete('/pelanggan/{id}', [PelangganController::class, 'destroy'])->name('pelanggan.destroy');
route::get('/pelanggan/{id}', [PelangganController::class, 'show'])->name('pelanggan.show');
route::get('/pelanggan/{id}/delete', [PelangganController::class, 'delete'])->name('pelanggan.delete');
route::get('/pelanggan/{id}/restore', [PelangganController::class, 'restore'])->name('pelanggan.restore');
route::get('/pelanggan/{id}/force-delete', [PelangganController::class, 'forceDelete'])->name('pelanggan.force-delete');
route::get('/pelanggan/trash', [PelangganController::class, 'trash'])->name('pelanggan.trash');
