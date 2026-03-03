<?php

/*use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::post('/check-email', function (Request $request) {
  \Log::info('api.php側メアド存在チェック');
    $exists = DB::table('users')->where('email', $request->input('email'))->exists();

    return response()->json(['exists' => $exists]);
});*/

use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\EmailCheckController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Log;

\Log::info('api.php発火');
//Route::post('/check-email', [EmailCheckController::class,'check']);
Route::post('/check-duplicate', [UserController::class, 'checkDuplicate']);
