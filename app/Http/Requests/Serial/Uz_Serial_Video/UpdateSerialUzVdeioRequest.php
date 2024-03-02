<?php

namespace App\Http\Requests\Serial\Uz_Serial_Video;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSerialUzVdeioRequest extends FormRequest
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
            'part.numeric' => 'The part must be a number.',
            'filmvideo.mimes' => 'The film or video must be a file of type: mp4, mov, avi, wmv.'
        ];
    }
}
