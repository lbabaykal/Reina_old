<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TypeRequest extends FormRequest
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
                'title_ru' => ['required', 'min:2', 'max:255', 'unique:types,title_ru', 'regex:/^[\p{Cyrillic}\s]+$/u'],
                'title_en' => ['required', 'min:2', 'max:255', 'unique:types,title_en', 'regex:/^[\p{Latin}\s]+$/u'],
            ];
        } elseif ($this->isMethod('PATCH')) {
            return [
                'title_ru' => ['required', 'min:2', 'max:255', 'regex:/^[\p{Cyrillic}\s]+$/u', Rule::unique('types')->ignore($this->type)],
                'title_en' => ['required', 'min:2', 'max:255', 'regex:/^[\p{Latin}\s]+$/u', Rule::unique('types')->ignore($this->type)],
            ];
        }
    }

//    public function withValidator($validator): void
//    {
//        $validator->sometimes('code', 'uppercase', function ($input) {
//            return $input->has('title_en');
//        });
//    }

}
