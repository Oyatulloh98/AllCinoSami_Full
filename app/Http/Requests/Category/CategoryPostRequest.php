<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class CategoryPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name_uz' => 'required|unique:categories,name_uz|max:255|regex:/^[a-zA-Z ]+$/',
            'name_ru' => 'required|unique:categories,name_ru|max:255|regex:/[А-Яа-яЁё]/u'
        ];
    }

    /**
     * Bu yerda messages yuboriladi
     */

    public function messages()
    {
        return [
            'name_uz.required' => 'The name_uz field is required.',
            'name_uz.unique' => 'The name_uz has already been taken.',
            'name_uz.max' => 'The name_uz may not be greater than 255 characters.',
            'name_uz.regex' => 'The name_uz format is invalid. Only letters and spaces are allowed.',

            'name_ru.required' => 'The name_ru field is required.',
            'name_ru.unique' => 'The name_ru has already been taken.',
            'name_ru.max' => 'The name_ru may not be greater than 255 characters.',
            'name_ru.regex' => 'The name_ru format is invalid. Only Cyrillic characters are allowed.'
        ];
    }
}
