<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AutocompleteController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
});

// Autocomplete routes
Route::group(['prefix' => 'autocomplete', 'as' => 'autocomplete.'], static function () {
})->middleware(['auth:sanctum']);

// Auth
Route::controller(LoginController::class)->group(static function () {
    Route::get('/', 'create')->name('login')->middleware('guest');
    Route::post('login', 'store')->middleware('guest');
    Route::delete('logout', 'destroy')->name('logout');
});
