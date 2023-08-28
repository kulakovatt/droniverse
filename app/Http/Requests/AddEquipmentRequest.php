<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddEquipmentRequest extends FormRequest
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
            'id' => 'required',
            'name' => 'required',
            'thumbnail' => 'required',
            'count' => 'required|integer',
        ];
    }

    public function messages()
    {
        return [
            'id' => [
                'required' => 'Выберите название дрона.',
            ],
            'name' => [
                'required' => 'Введите название комплектующего.',
            ],
            'thumbnail' => [
                'required' => 'Выберите изображение.'
            ],
            'count' => [
                'required' => 'Введите количество.',
                'numeric' => 'Количество должно принимать целое число.'
            ]
        ];
    }
}
