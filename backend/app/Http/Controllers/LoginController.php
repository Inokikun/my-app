<?php

namespace App\Http\Controllers;

//use App\Actions\User\CreateUser;
//use App\Http\Requests\StoreUserRequest;
//use Illuminate\Http\JsonResponse;
//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;

class LoginController  extends Controller
{
    public function showLoginForm()
    {
        \Log::info('LoginController.phpのshowLoginFormメソッド発火');
        return view('auth.login');
    }

    // file:///C:/Users/owner/Desktop/vue.js,TypeScript,Laravel,docker/reference_file/6.docx
    public function login(LoginRequest $request)
    {
      // バリデーションと認証処理
      //$credentials = $request->validate([
      //'name' => ['required'],
      //'password' => ['required'],
      //]);

      //if (Auth::attempt([
        //'name' => $credentials['name'],
        //'password' => $credentials['password'],
      //])) {

      //if (Auth::attempt($request->only('name', 'password'))) {
      if (Auth::attempt($request->validated())) {
        // セッション再生成（セキュリティ対策）
        // file:///C:/Users/owner/Desktop/vue.js,TypeScript,Laravel,docker/reference_file/7.docx
        $request->session()->regenerate();

        // 成功時のリダイレクト
        // file:///C:/Users/owner/Desktop/vue.js,TypeScript,Laravel,docker/reference_file/8.docx
        //return redirect()->intended('/dashboard');
        \Log::info('ログイン成功');
        return view('home.aaa');
      }

      // 認証失敗時
      \Log::info('ログイン失敗');
      // file:///C:/Users/owner/Desktop/vue.js,TypeScript,Laravel,docker/reference_file/12.docx
      return back()
        ->withErrors(['auth' => 'ユーザ名またはパスワードが違います'])
        ->withInput();
    }
}
