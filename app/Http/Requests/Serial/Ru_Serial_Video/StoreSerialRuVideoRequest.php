<?php

namespace App\Http\Requests\Serial\Ru_Serial_Video;

use Illuminate\Foundation\Http\FormRequest;

class StoreSerialRuVideoRequest extends FormRequest
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
        // dd($_REQUEST);
        return [
            'category' => 'required|numeric',
            'brand' => 'required|numeric',
            'name_uz' => 'required|numeric',
            'name_ru' => 'required|numeric',
            'part' => 'required|numeric',
            'serialvideo' => 'required|mimes:mp4,mov,avi,wmv',
        ];
    }

    public function messages(): array
    {
        return [
            'category.required' => 'Kategoriya maydoni to\'ldirilishi shart.',
            'category.numeric' => 'Kategoriya raqam bo\'lishi kerak.',
            'brand.required' => 'Brend maydoni to\'ldirilishi shart.',
            'brand.numeric' => 'Brend raqam bo\'lishi kerak.',
            'name_uz.required' => 'Nomi (uzbekcha) maydoni to\'ldirilishi shart.',
            'name_uz.regex' => 'Nomi (uzbekcha) faqat harflar va probellar bo\'lishi kerak.',
            'name_ru.required' => 'Nomi (ruscha) maydoni to\'ldirilishi shart.',
            'name_ru.regex' => 'Nomi (ruscha) faqat kirill alifbosidagi belgilardan iborat bo\'lishi kerak.',
            'part.required' => 'Part raqamini kiritish shart.',
            'part.numeric' => 'Part raqam bo\'lishi kerak.',
            'part.unique' => 'Bu part raqami allaqachon mavjud. Boshqa raqam kiriting.',
            'serialvideo.required' => 'Serial video fayli to\'ldirilishi shart.',
            'serialvideo.mimes' => 'Serial video fayli mp4, mov, avi yoki wmv formatda bo\'lishi kerak.',
        ];
    }
}