<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

\Log::info('process.php発火');
Route::post('/', [LoginController::class, 'login'])->name('process');
