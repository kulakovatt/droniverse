<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UsersRequest extends FormRequest
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
            'login' => 'required|alpha_dash|unique:App\Models\Users,login',
            'password' => [
                'required',
                Password::min(7)
//                    ->letters()
//                    ->mixedCase()
//                    ->numbers()
//                    ->symbols()
//                    ->uncompromised()
            ],
            'repeat_password' => 'required|same:password',
            'email' => 'required|email:rfc,dns'
        ];
    }

    public function messages()
    {
        return [
            'login.required' => 'Логин является обязательным.',
            'login.unique' => 'Такой логин уже существует.',
            'login.alpha_dash' => 'Логин может содержать только буквенно-цифровые символы, а также дефисы и символы подчеркивания.',
            'password.required' => 'Пароль является обязательным.',
            'password.min' => 'Пароль должен содержать не менее 7 символов.',
            'password' => [
                'letters' => 'Пароль должен содержать хотя бы одну букву.',
                'mixed' => 'Пароль должен содержать как минимум одну заглавную и одну строчную букву.',
                'numbers' => 'Пароль должен содержать хотя бы одну цифру.',
                'symbols' => 'Пароль должен содержать хотя бы один символ.',
                'uncompromised' => 'Данный пароль появился в утечке данных. Пожалуйста, выберите другой пароль.',
            ],
            'repeat_password.required' => 'Поле повторить пароль является обязательным.',
            'repeat_password.same' => 'Пароли не совпадают.',
            'email.required' => 'Email является обязательным.',
            'email.email' => 'Email некорректный.'
        ];
    }
}
