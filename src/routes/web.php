<?php

use Illuminate\Support\Facades\Route;
use Livewire\Livewire;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\GajiController;

/* NOTE: Do Not Remove
/ Livewire asset handling if using sub folder in domain
*/
Livewire::setUpdateRoute(function ($handle) {
    return Route::post(config('app.asset_prefix') . '/livewire/update', $handle);
});

Livewire::setScriptRoute(function ($handle) {
    return Route::get(config('app.asset_prefix') . '/livewire/livewire.js', $handle);
});

Route::resource('karyawans', KaryawanController::class);
Route::resource('gajis', GajiController::class);
Route::resource('karyawans', \App\Http\Controllers\KaryawanController::class);

/*
/ END
*/
Route::get('/', function () {
    return view('welcome');
});
