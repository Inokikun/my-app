<?php

// file:///C:/Users/owner/Desktop/vue.js,TypeScript,Laravel,docker/reference_file/4.docx
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;



//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
//use App\Models\User;



\Log::info('web.php発火');
Route::get('/', [HomeController::class,'index']);

//ルートグルーピングしないときはweb.php内に
//require __DIR__.を書いて目的のルーティングファイルを呼び出し、
//そのルーティングファイル内にgetとpostの両方を書く
//そこからgetもpostも同じコントローラーファイルに飛び、
//getならcreateメソッド、postならstoreメソッドを実行
//require __DIR__.'/accounts/entry_route.php';

//ルートグルーピングするときは、web.php内でget用とpost用の
//require __DIR__ .を書き、ルーティングファイルはpostとget
//でファイルを分け、コントローラーファイルは1つのファイル内に
//createメソッドとstoreメソッドを書く
//グルーピングの書き方については命名規則のワードファイルに記載
// file:///C:/Users/owner/Desktop/vue.js,TypeScript,Laravel,docker/reference_file/2.docx
Route::prefix('accounts')->name('accounts.')->group(function () {
    require __DIR__ . '/accounts/create.php';
    require __DIR__ . '/accounts/store.php';
});

Route::prefix('login')->name('login.')->group(function () {
    require __DIR__ . '/login/form.php';
    require __DIR__ . '/login/process.php';
});
