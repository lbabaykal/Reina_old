<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
{
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
                'title' => ['nullable', 'string', 'max:255'],
                'strict_genre' => ['nullable', 'in:on'],
                'strict_studio' => ['nullable', 'in:on'],

                'type' => ['nullable'],
                'type.*' => ['nullable', 'integer'],

                'genre' => ['nullable', 'array'],
                'genre.*' => ['nullable', 'integer'],

                'studio' => ['nullable', 'array'],
                'studio.*' => ['nullable', 'integer'],

                'country' => ['nullable', 'array'],
                'country.*' => ['nullable', 'integer'],

                'year_from' => ['nullable', 'integer'],
                'year_to' => ['nullable', 'integer'],

                'sorting' => ['nullable', 'integer'],
            ];
    }

}
