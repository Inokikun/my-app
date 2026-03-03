<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class PasswordStrengthRule implements Rule
{
    protected array $failedConditions = [];

    public function passes($attribute, $value): bool
    {
        $this->failedConditions = [];

        if (trim($value) === '') {
            $this->failedConditions[] = 'empty';
            return false;
        }

        if (mb_strlen($value) < 10) {
            $this->failedConditions[] = 'minlength';
            return false;
        }

        if (!preg_match('/[a-z]/', $value)) {
            $this->failedConditions[] = 'lowercase';
        }

        if (!preg_match('/[A-Z]/', $value)) {
            $this->failedConditions[] = 'uppercase';
        }

        if (!preg_match('/[0-9]/', $value)) {
            $this->failedConditions[] = 'number';
        }

        return empty($this->failedConditions);
    }

    public function message(): string
    {
        $messages = [];

        foreach ($this->failedConditions as $condition) {
            $messages[] = match ($condition) {
                'empty'     => 'パスワードを入力してください',
                'minlength' => 'パスワードは10文字以上にしてください',
                'lowercase' => 'パスワードには半角英小文字を含めてください',
                'uppercase' => 'パスワードには半角英大文字を含めてください',
                'number'    => 'パスワードには半角数字を含めてください',
                default     => 'パスワードの形式が正しくありません',
            };
        }

        return implode("\n", $messages);
    }
}
