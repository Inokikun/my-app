<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageController;

\Log::info('form.php発火');
Route::get('/', [ImageController::class, 'showUploadForm'])->name('form');
