<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LogoutController;

\Log::info('logoutのprocess.php発火');
Route::post('/', [LogoutController::class, 'logout'])->name('process');
