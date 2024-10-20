<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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
    return view('pages.register');
});

/**
 * Auth Routes
 */
Route::controller(UserController::class)->group(function() {
    Route::get('/dashboard/{url}', 'dashboard')->name('dashboard');
    Route::patch('/regenerate', 'regenerateUrl')->name('regenerate-url');
    Route::patch('/deactivate', 'deactivateUrl')->name('deactivate-url');
    
    /**
     * AJAX
     */
    Route::prefix('ajax')->group(function() {
        Route::post('/register', 'register')->name('ajax.register');
        Route::post('/imfeelinglucky', 'imfeelinglucky')->name('ajax.imfeelinglucky');
        Route::get('/history', 'history')->name('ajax.history');
    });
});
