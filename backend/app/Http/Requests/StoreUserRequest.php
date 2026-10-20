<?php

namespace App\Http\Requests;
use App\Rules\NameRule;
use App\Rules\PasswordStrengthRule;
use App\Rules\EmailRule;

use Illuminate\Foundation\Http\FormRequest;

/*新奇アカウント作成の時のバリデーション*/
// file:///C:/Users/owner/Desktop/vue.js,TypeScript,Laravel,docker/reference_file/1.docx
class StoreUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // 認可処理が不要な場合は true に
    }

    public function rules(): array
    {
        return [
            'name'     => new NameRule,
            'password' => new PasswordStrengthRule,
            'email'    => new EmailRule,
        ];
    }
}
