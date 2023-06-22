<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AutocompleteController;
use App\Http\Controllers\BulkMessageController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PointController;
use App\Http\Controllers\PointTransactionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::resource('users', UserController::class);
    Route::resource('clients', ClientController::class);
    Route::resource('points', PointController::class);
    Route::resource('point-transactions', PointTransactionController::class);

    Route::group(['prefix' => '/bulk-messages/{bulkMessage}/'], function () {
        Route::post('repeat-sending', [BulkMessageController::class, 'repeatSending'])->name('bulk-messages.repeat-sending');
        Route::post('mark-as-sending', [BulkMessageController::class, 'markAsSending'])->name('bulk-messages.mark-as-sending');
        Route::post('mark-as-cancel', [BulkMessageController::class, 'markAsCancel'])->name('bulk-messages.mark-as-cancel');
    });

    Route::resource('bulk-messages', BulkMessageController::class);
});

// Autocomplete routes
Route::group(['prefix' => 'autocomplete', 'as' => 'autocomplete.'], static function () {
    Route::get('clients', [AutocompleteController::class, 'clients'])->name('clients');
})->middleware(['auth:sanctum']);

// Auth
Route::controller(LoginController::class)->group(static function () {
    Route::get('/', 'create')->name('login')->middleware('guest');
    Route::post('login', 'store')->middleware('guest');
    Route::delete('logout', 'destroy')->name('logout');
});
