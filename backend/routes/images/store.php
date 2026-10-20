<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageController;

\Log::info('store.php発火');
Route::post('/', [ImageController::class, 'store'])->name('store');
