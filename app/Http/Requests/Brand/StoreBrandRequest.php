<?php

namespace App\Http\Requests\Brand;

use App\Models\Brand;
use Illuminate\Foundation\Http\FormRequest;

class StoreBrandRequest extends FormRequest
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
            'categories' => 'required|numeric',
            'name' => [
                'required',
                function ($attribute, $value, $fail) {
                    $this->checkBrand($attribute, $value, $fail);
                }
            ],

        ];
    }

    /**
     *  Bu yerda brand takrorlanib qolmasligi uchun validatsiya qilyapman brand 
     */

    protected function checkBrand($attribute, $value, $fail)
    {
        $existingBrand = Brand::where('category_id', $this->categories)
            ->where('name', $this->name)
            ->exists();
        if ($existingBrand) {
            $fail("Bu brend oldin kiritilgan");
        }
    }

    /**
     *  Bu yerda brand xatoligiga oid messagelar qayatariladi
     */
    public function messages(): array
    {
        return [
            'category.required'      => 'Kategoriya maydoni to\'ldirilishi shart.',
            'category.numeric'       => 'Kategoriya raqam bo\'lishi kerak.',
            'name.required'          => 'Brend maydoni to\'ldirilishi shart.',
            'check_brand'            => 'Bu brend oldin kiritilgan'
        ];
    }
}
