<?php

namespace App\Actions\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

/*データベースにユーザー名、パスワード、メールアドレスを登録*/
class CreateUser
{
    //AccountControllerからこの関数が呼ばれるので
    //array型の仮引数を変数dataで受け取るということ
    public function execute(array $data): User
    {
        return User::create([
            'name' => $data['name'],
            'password' => Hash::make($data['password']),
            'email' => $data['email'],
        ]);
    }
}
