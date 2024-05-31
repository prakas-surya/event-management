<?php

use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('events')->group(function () {
    Route::get('', [EventController::class, 'index'])->name('events.index');
    Route::get('/create', [EventController::class, 'create'])->name('events.create');
    Route::post('/store', [EventController::class, 'store'])->name('events.store');
    Route::get('/edit/{id}', [EventController::class, 'edit'])->name('events.edit');
    Route::post('/update/{id}', [EventController::class, 'update'])->name('events.update');
    Route::delete('/destroy/{id}', [EventController::class, 'destroy'])->name('events.destroy');
});
