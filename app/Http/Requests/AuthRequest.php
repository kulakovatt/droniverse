<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'login' => 'required|exists:App\Models\Users,login',
            'password' => 'required|min:7'
        ];
    }

    public function messages()
    {
        return [
            'login.required' => 'Логин является обязательным.',
            'login.exists' => 'Такого логина не существует.',
            'password' => [
                'required' => 'Пароль является обязательным.',
                'min' => 'Пароль должен содержать не менее 7 символов.'
            ]

        ];
    }
}
