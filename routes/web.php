<?php

use App\Http\Controllers\ClientController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ClientController::class, 'index']);
Route::get('/clientEdit/{id}', [ClientController::class, 'edit'])->name('client.edit');
Route::delete('/clientDelete/{id}', [ClientController::class, 'destroy'])->name('client.delete');
Route::get('/clientCreate', [ClientController::class, 'create'])->name('client.create');
Route::post('/clientStore', [ClientController::class, 'store'])->name('client.store');
Route::patch('/clientUpdate/{id}', [ClientController::class, 'update'])->name('client.update');
