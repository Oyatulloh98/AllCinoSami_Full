<?php

namespace App\Http\Requests\Brand;

use App\Models\Brand;
use Illuminate\Foundation\Http\FormRequest;

class UpdateBrandRequest extends FormRequest
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
            'name' => [
                'required',
                'max:255',
                'regex:/^[a-zA-Z ]+$/',
                function ($attribute, $value, $fail) {
                    $this->checkBrand($attribute, $value, $fail);
                }
            ]
        ];
    }

    /**
     * Bu yerda Categoryni o'zi kelib qolsa ham update qiladi 
     */
    protected function checkBrand($attribute, $value, $fail)
    {
        $brand = $this->route('brand');
        $brand_id = $brand['id'];
        $brand = Brand::where('id', $brand_id)->first();
        if ($brand) {
            $existingBrand = Brand::where('id', '!=', $brand_id)
                ->where('category_id', $this->input('categories'))
                ->where('name', $this->input('name'))
                ->exists();
            if ($existingBrand) {
                $fail('Bu brand oldin kiritilgan');
            }
        } else {
            $fail('Bu brand oldin kiritilgan');
        }
    }

    /**
     * Bu yerda messages yuboriladi
     */
    public function messages()
    {
        return [
            'name_uz.required' => 'The name_uz field is required.',
            'check_brand' => 'The name_uz has already been taken.',
            'name_uz.max' => 'The name_uz may not be greater than 255 characters.',
            'name_uz.regex' => 'The name_uz format is invalid. Only letters and spaces are allowed.',

            'name_ru.required' => 'The name_ru field is required.',
            'check_brand' => 'The name_ru has already been taken.',
            'name_ru.max' => 'The name_ru may not be greater than 255 characters.',
            'name_ru.regex' => 'The name_ru format is invalid. Only Cyrillic characters are allowed.'
        ];
    }
}
