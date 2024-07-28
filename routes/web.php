<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NameController;


Route::get('/', function () {
    return view('welcome');
});





Route::get('/create', [NameController::class, 'create'])->name('names.create');
Route::post('/names', [NameController::class, 'store'])->name('names.store');





use App\Http\Controllers\MahasiswaController;

Route::resource('mahasiswa', MahasiswaController::class);
