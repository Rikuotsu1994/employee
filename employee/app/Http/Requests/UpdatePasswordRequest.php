<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UpdatePasswordRequest extends FormRequest
{
    /**
    * @return bool
    */
    public function authorize()
    {
        return true;
    }

    /**
    * @return array
    */
    public function rules(): array
    {
        return [
            'current_password' => ['required'],
            'password' => ['required', 'min:8', 'confirmed']
        ];
    }

    /**
    * @return array
    */
    public function messages(): array
    {
        return [
            'current_password.required' => 'パスワードを入力してください。',
            'password.required' => 'パスワードを入力してください。',
            'password.min' => 'パスワードは8文字以上入力してください。',
            'password.confirmed' => '確認用パスワードと一致しません。',
        ];
    }

    /**
    * @return void
    */
    public function withValidator(Validator $validator): void
    {
        $validator->after(function ($validator) {
            $worker = Auth::user();
            if (!(Hash::check($this->input('current_password'), $worker->password))) {
                $validator->errors()->add('current_password', __('現在のパスワードに誤りがあります。'));
            }
        });
    }
}