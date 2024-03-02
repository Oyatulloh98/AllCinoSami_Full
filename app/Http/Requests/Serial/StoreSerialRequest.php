<?php

namespace App\Http\Requests\Serial;

use App\Models\Serial;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\Console\Input\Input;

class StoreSerialRequest extends FormRequest
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
        // dd($_REQUEST,$_FILES);
        return [
            'category' => 'required|numeric',
            'brand' => 'required|numeric',
            'name_uz' => [
                'required',
                'regex:/^[a-zA-Z0-9 ]+$/',
                function ($attribute, $value, $fail) {
                    $this->checkSerial($attribute, $value, $fail);
                }
            ],
            'name_ru' => [
                'required',
                'regex:/[А-Яа-яЁё0-9]/u',
                function ($attribute, $value, $fail) {
                    $this->checkSerial($attribute, $value, $fail);
                }
            ],
            'imageserial' => 'required|image|mimes:jpg,jpeg,png,webp',
        ];
    }

    /**
     * Bu yerda malumot oldin kiritilgan yo kiritilmaganligiga tekshiradigan funcsiaya yozildi
     * nomi checkSerial 
     */
    protected function checkSerial($attribute, $value, $fail)
    {
        $existingSerial = Serial::where('category_id', $this->input('category'))
            ->where('brand_id', $this->input('brand'))
            ->where('name_uz', $this->input('name_uz'))
            ->where('name_ru', $this->input('name_ru'))
            ->exists();
        if ($existingSerial) {
            $fail('Bu serial allaqachon kiritilgan');
        }
    }

    public function messages(): array
    {
        return [
            'category.required' => 'Kategoriya maydoni to\'ldirilishi shart.',
            'category.numeric' => 'Kategoriya raqam bo\'lishi kerak.',
            'brand.required' => 'Brend maydoni to\'ldirilishi shart.',
            'brand.numeric' => 'Brend raqam bo\'lishi kerak.',
            'name_uz.required' => 'Nomi (uzbekcha) maydoni to\'ldirilishi shart.',
            'name_uz.unique' => 'Bu serial oldin kiritilgan. Iltimos, boshqa nom kiriting.',
            'name_uz.regex' => 'Nomi (uzbekcha) faqat harflar va probellar bo\'lishi kerak.',
            'name_ru.required' => 'Nomi (ruscha) maydoni to\'ldirilishi shart.',
            'name_ru.unique' => 'Bu serial oldin kiritilgan. Iltimos, boshqa nom kiriting.',
            'name_ru.regex' => 'Nomi (ruscha) faqat kirill alifbosidagi belgilardan iborat bo\'lishi kerak.',
            'imageserial.required' => 'Rasm fayli maydoni to\'ldirilishi shart.',
            'imageserial.image' => 'Rasm fayli yuqori sifatli rasm bo\'lishi kerak.',
            'imageserial.mimes' => 'Rasm fayli jpg, jpeg yoki png formatda bo\'lishi kerak.',
            'check_serial' => 'Bu serial allaqachon kiritilgan'
        ];
    }
}
