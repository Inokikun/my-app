<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{

    // file:///C:/Users/owner/Desktop/vue.js,TypeScript,Laravel,docker/reference_file/10.docx
    public function authorize()
    {
        return true; // ログインは誰でも試せるので true
    }

    public function rules()
    {
      // file:///C:/Users/owner/Desktop/vue.js,TypeScript,Laravel,docker/reference_file/11.docx
      return [
          'name' => [
              'required',
              'string',
              'max:255',
              // 'regex:/^[a-zA-Z0-9_-]+$/', // 必要に応じて
          ],
          'password' => [
              'required',
              'string',
              'min:10',
          ],
      ];
    }

    public function messages()
    {
        return [
            'name.required' => 'ユーザー名を入力してください',
            'name.string'   => 'ユーザー名は文字列で入力してください',
            'name.max'      => 'ユーザー名は255文字以下で入力してください',

            'password.required' => 'パスワードを入力してください',
            'password.string'   => 'パスワードは文字列で入力してください',
            'password.min'      => 'パスワードは10文字以上にしてください',
        ];
    }

}
