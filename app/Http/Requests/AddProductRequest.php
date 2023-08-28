<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddProductRequest extends FormRequest
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
            'name' => 'required|unique:App\Models\Products,name',
            'brand' => 'required|string',
            'model' => 'required|string',
            'thumbnail' => 'required',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'count' => 'required|integer',
            'characteristics' => 'required|string'
        ];
    }

    public function messages()
    {
        return [
            'name' => [
                'required' => 'Введите наименование.',
                'unique:App\Models\Products,name' => 'Наименование должно быть уникальным.'
            ],
            'brand' => [
                'required' => 'Введите бренд.',
                'string' => 'Бренд должен принимать строку.'
            ],
            'model' => [
                'required' => 'Введите модель.',
                'string' => 'Модель должна принимать строку.'
            ],
            'thumbnail' => [
                'required' => 'Выберите изображение.',
                'image' => 'Файл должен представлять собой изображение.'
            ],
            'description' => [
                'required' => 'Введите описание.',
                'string' => 'Описание должно принимать строку.'
            ],
            'price' => [
                'required' => 'Введите цену.',
                'numeric' => 'Цена должна принимать целое или дробное число.'
            ],
            'count' => [
                'required' => 'Введите количество.',
                'numeric' => 'Количество должно принимать целое число.'
            ],
            'characteristics' => [
                'required' => 'Заполните характеристики.',
                'string' => 'Характеристики должны принимать строку.'
            ]
        ];
    }
}
