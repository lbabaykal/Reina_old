<?php

namespace App\Http\Requests\AdminPanel;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CountryUpdateRequest extends FormRequest
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
        return [
            'title_ru' => ['required', 'min:2', 'max:255', 'regex:/^[\p{Cyrillic}\s]+$/u', Rule::unique('countries')->ignore($this->country)],
            'title_en' => ['required', 'min:2', 'max:255', 'regex:/^[\p{Latin}\s]+$/u', Rule::unique('countries')->ignore($this->country)],
        ];
    }

}
