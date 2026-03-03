<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

\Log::info('form.php発火');
Route::get('/', [LoginController::class, 'showLoginForm'])->name('form');
