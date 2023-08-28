<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddTrainingRequest extends FormRequest
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
            'name' => 'required|unique:App\Models\Training,name',
            'date' => 'required',
            'thumbnail' => 'required',
            'description' => 'required|string',
            'address' => 'required|string',
            'count' => 'required|integer',
            'time' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name' => [
                'required' => 'Введите название мастер-класса.',
                'unique:App\Models\Products,name' => 'Название должно быть уникальным.'
            ],
            'date' => [
                'required' => 'Выберите дату.',
            ],
            'thumbnail' => [
                'required' => 'Выберите изображение.'
            ],
            'description' => [
                'required' => 'Введите описание.',
                'string' => 'Описание должно принимать строку.'
            ],
            'address' => [
                'required' => 'Введите адрес проведения.',
                'string' => 'Адрес должен принимать строку.'
            ],
            'count' => [
                'required' => 'Введите количество мест.',
                'numeric' => 'Количество должно принимать целое число.'
            ],
            'time' => [
                'required' => 'Выберите время.',
            ]
        ];
    }
}
