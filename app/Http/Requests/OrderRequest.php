<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'lastname' => 'required|alpha',
            'firstname' => 'required|alpha',
            'surname' => 'required|alpha',
            'phone' => ['required', 'regex:/^\+375\s?(17|25|29|33|44)\s?\d{3}\d{2}\d{2}$/'],
            'delivery' => 'required|in:courier,pickup',
            'address' => 'sometimes|required_if:delivery,courier',
            'date_delivery' => 'sometimes|required_if:delivery,courier',
            'payment' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'lastname' => [
                'required' => 'Введите фамилию.',
                'alpha' => 'Фамилия должна состоять из букв.'
            ],
            'firstname' => [
                'required' => 'Введите имя.',
                'alpha' => 'Имя должно состоять из букв.'
            ],
            'surname' => [
                'required' => 'Введите отчество',
                'alpha' => 'Отчество должно состоять из букв.'
            ],
            'phone' => [
                'required' => 'Введите телефон.',
                'regex' => 'Телефон должен быть введен в формате (+37529...).'
            ],
            'delivery' => [
                'required' => 'Выберите способ доставки.',
            ],
            'address' => [
                'required' => 'Введите адрес доставки.',
            ],
            'date_delivery' => [
                'required' => 'Выберите дату доставки.',
            ],
            'payment' => [
                'required' => 'Выберите способ оплаты.',
            ]
        ];
    }
}
