<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlternativeController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/alternatives', [AlternativeController::class, 'index'])->name('alternatives.index');
Route::get('/alternatives/create', [AlternativeController::class, 'create'])->name('alternatives.create');
Route::post('/alternatives', [AlternativeController::class, 'store'])->name('alternatives.store');