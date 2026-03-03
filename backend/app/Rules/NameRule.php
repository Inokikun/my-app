<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class NameRule implements Rule
{
    protected array $failedConditions = [];

    public function passes($attribute, $value): bool
    {
        $this->failedConditions = [];

        if (trim($value) === '') {
            $this->failedConditions[] = 'empty';
            return false;
        }

        if (mb_strlen($value) > 255) {
            $this->failedConditions[] = 'too_long';
            return false;
        }

        if (!is_string($value)) {
            $this->failedConditions[] = 'not_string';
        }

        if (preg_match('/^\d+$/', $value)) {
            $this->failedConditions[] = 'numeric_only';
        }

        if (!preg_match('/^[\p{L}\p{N}\p{Zs}ー－―‐（）()ａ-ｚＡ-Ｚ０-９ｦ-ﾟァ-ヶー一-龠ぁ-ん]+$/u', $value)) {
            $this->failedConditions[] = 'invalid_format';
        }

        return empty($this->failedConditions);
    }

    public function message(): string
    {
        $messages = [];

        foreach ($this->failedConditions as $condition) {
            $messages[] = match ($condition) {
                'empty'        => 'ユーザー名を入力してください',
                'too_long'     => 'ユーザー名は255文字以下で入力してください',
                'not_string'   => 'ユーザー名は文字列で入力してください',
                'numeric_only' => 'ユーザー名に数字だけを使用することはできません',
                'invalid_format' => 'ユーザー名の形式が正しくありません（日本語・英数字・記号のみ使用可能）',
                default        => 'ユーザー名の形式が正しくありません',
            };
        }

        return implode("\n", $messages);
    }
}
