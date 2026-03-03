<?php

namespace App\Http\Requests;
use App\Rules\NameRule;
use App\Rules\PasswordStrengthRule;
use App\Rules\EmailRule;

use Illuminate\Foundation\Http\FormRequest;

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
