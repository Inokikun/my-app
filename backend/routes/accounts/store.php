<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;

\Log::info('store.php発火');
//web.phpでルートグルーピングしているため
//URLとnameの頭にaccountsが付く
//③bladeのみで完結(vueをマウントしない):route()ヘルパーを使う//
//->name('store')は遷移させたいRouteの所に書く
//このファイルはpostの時に実行
Route::post('/', [AccountController::class,'store'])->name('store');
