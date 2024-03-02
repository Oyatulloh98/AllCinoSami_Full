<?php

namespace App\Http\Requests\Film;

use App\Models\Film;
use Illuminate\Foundation\Http\FormRequest;

class UpdateFilmRequest extends FormRequest
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
            'category'   => 'required|numeric',
            'brand'      => 'required|numeric',
            'name_uz'    => [
                'required',
                'max:255',
                'regex:/^[a-zA-Z ]+$/',
                function ($attribute, $value, $fail) {
                    $this->checkFilm($attribute, $value, $fail);
                },
            ],
            'name_ru'    => [
                'required',
                'max:255',
                'regex:/[А-Яа-яЁё]/u',
                function ($attribute, $value, $fail) {
                    $this->checkFilm($attribute, $value, $fail);
                },
            ],
            'imagefilm'  => 'image|mimes:jpg,jpeg,png',
        ];
    }

    /**
     * Check if the film already exists.
     *
     * @param string $attribute
     * @param mixed $value
     * @param \Closure $fail
     * @return void
     */
    protected function checkFilm($attribute, $value, $fail)
    {
        $film = $this->route('film');
        $id = $film['id'];
        $film = Film::where('id', $id)->first();
        if ($film) {
            $existingFilm = Film::where('id', '!=',  $id)
                ->where('category_id', $this->input('category'))
                ->where('brand_id', $this->input('brand'))
                ->where('name_uz', $this->input('name_uz'))
                ->where('name_ru', $this->input('name_ru'))
                ->exists();
            if ($existingFilm) {
                $fail('Bu film oldin kiritilgan');
            }
        }
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'category.required'      => 'Kategoriya maydoni to\'ldirilishi shart.',
            'category.numeric'       => 'Kategoriya raqam bo\'lishi kerak.',
            'brand.required'         => 'Brend maydoni to\'ldirilishi shart.',
            'brand.numeric'          => 'Brend raqam bo\'lishi kerak.',
            'name_uz.required'       => 'Nomi (uzbekcha) maydoni to\'ldirilishi shart.',
            'name_uz.regex'          => 'Nomi (uzbekcha) faqat harflar va probellar bo\'lishi kerak.',
            'name_ru.required'       => 'Nomi (ruscha) maydoni to\'ldirilishi shart.',
            'name_ru.regex'          => 'Nomi (ruscha) faqat kirill alifbosidagi belgilardan iborat bo\'lishi kerak.',
            'imageserial.required'   => 'Rasm fayli maydoni to\'ldirilishi shart.',
            'imageserial.image'      => 'Rasm fayli yuqori sifatli rasm bo\'lishi kerak.',
            'imageserial.mimes'      => 'Rasm fayli jpg, jpeg yoki png formatda bo\'lishi kerak.',
            'check_film'             => 'Bu film oldin kiritilgan',
        ];
    }
}
