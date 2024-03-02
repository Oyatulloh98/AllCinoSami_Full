<?php

namespace App\Http\Requests\Film\Film_Ru_Video;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFilmRuVideo extends FormRequest
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
            'name_uz' => [
                'required',
                'numeric',
            ],
            'name_ru' => [
                'required',
                'numeric',
            ],
            'part' => [
                'numeric'
            ],
            'filmvideo' => [
                'mimes:mp4,mov,avi,wmv'
            ]
        ];
    }

    public function messages()
    {
        return [
            'name_uz.required' => 'The Uzbek name field is required.',
            'name_uz.numeric' => 'The Uzbek name must be a number.',
            'name_ru.required' => 'The Russian name field is required.',
            'name_ru.numeric' => 'The Russian name must be a number.',
            'part.numeric' => 'The part must be a number.',
            'filmvideo.mimes' => 'The film or video must be a file of type: mp4, mov, avi, wmv.'
        ];
    }
}
