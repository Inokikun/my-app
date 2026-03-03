<?php

namespace App\Http\Controllers;

use App\Actions\User\CreateUser;
use App\Http\Requests\StoreUserRequest;
//use Illuminate\Http\JsonResponse;
//use Illuminate\Http\Request;

class AccountController  extends Controller
{
    public function create()
    {
        //echo "2025/5/11";
        \Log::info('AccountController.phpのcreateメソッド発火');
        return view('auth.register');
    }

    //login_routeからの呼び出し
    //Laravelが「コントローラの引数に渡すとき」に限って自動的にインスタンス化する
    // file:///C:/Users/owner/Desktop/vue.js,TypeScript,Laravel,docker/reference_file/1.docx
    //新規アカウント作成のバリデーションとMySQLへの登録については
    //mysql、バリデーションファイルの91ページから186ページまでの中に書いてある(時々関係ない質疑もある)
    public function store(StoreUserRequest $request, CreateUser $createUser)
    {
        \Log::info('AccountController.phpのstoreメソッド発火');
        //($request->validated())の戻り値はarray型
        $user = $createUser->execute($request->validated());

        //return response()->json([
            //'message' => 'User created successfully.',
            //'user' => $user,
        //], 201);

      // file:///C:/Users/owner/Desktop/vue.js,TypeScript,Laravel,docker/reference_file/5.docx
      return redirect()->route('login.form');
    }
}
