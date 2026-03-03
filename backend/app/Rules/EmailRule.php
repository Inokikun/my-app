<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class EmailRule implements Rule
{
    protected array $failedConditions = [];

    public function passes($attribute, $value): bool
    {
        $this->failedConditions = [];

        if (trim($value) === '') {
            $this->failedConditions[] = 'empty';
            return false;
        }

        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $this->failedConditions[] = 'invalid_format';
        }

        if (DB::table('users')->where('email', $value)->exists()) {
            $this->failedConditions[] = 'duplicate';
        }

        return empty($this->failedConditions);
    }

    public function message(): string
    {
        $messages = [];

        foreach ($this->failedConditions as $condition) {
            $messages[] = match ($condition) {
                'empty'          => 'メールアドレスを入力してください',
                'invalid_format' => 'メールアドレスの形式が正しくありません',
                'duplicate'      => 'このメールアドレスはすでに登録されています',
                default          => 'メールアドレスが無効です',
            };
        }

        return implode("\n", $messages);
    }
}
