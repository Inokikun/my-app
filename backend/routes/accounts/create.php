<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;

\Log::info('create.php発火');
//web.phpでルートグルーピングしているため
//URLとnameの頭にaccountsが付く
//->name('create')は遷移させたいRouteの所に書く
//このファイルはgetの時に実行
Route::get('/create', [AccountController::class,'create'])->name('create');
