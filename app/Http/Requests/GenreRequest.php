<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GenreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        if ($this->isMethod('POST')) {
            return [
                'title_ru' => ['required', 'min:2', 'max:255', 'unique:genres,title_ru', 'regex:/^[\p{Cyrillic}\s]+$/u'],
                'title_en' => ['required', 'min:2', 'max:255', 'unique:genres,title_en', 'regex:/^[\p{Latin}\s]+$/u'],
            ];
        } elseif ($this->isMethod('PATCH')) {
            return [
                'title_ru' => ['required', 'min:2', 'max:255', 'regex:/^[\p{Cyrillic}\s]+$/u', Rule::unique('genres')->ignore($this->genre)],
                'title_en' => ['required', 'min:2', 'max:255', 'regex:/^[\p{Latin}\s]+$/u', Rule::unique('genres')->ignore($this->genre)],
            ];
        }
    }

}
