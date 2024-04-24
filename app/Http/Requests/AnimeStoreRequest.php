<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;

class AnimeStoreRequest extends FormRequest
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
            'poster' => ['nullable', File::image()->min('1kb')->max('2mb')],
            'cover' => ['nullable', File::image()->min('1kb')->max('2mb')],

            'title_org' => ['required', 'string', 'min:1', 'max:255', 'unique:animes,title_org'],
            'title_ru' => ['required', 'string', 'min:1', 'max:255',  'unique:animes,title_ru'],
            'title_en' => ['required', 'string', 'min:1', 'max:255', 'unique:animes,title_en'],

            'type' => ['required', 'integer', 'exists:types,id'],

            'genres' => ['nullable', 'array'],
            'genres.*' => ['nullable', 'integer', 'exists:genres,id'],

            'studios' => ['nullable', 'array'],
            'studios.*' => ['nullable', 'integer', 'exists:studios,id'],

            'country' => ['required', 'integer', 'exists:countries,id'],

            'age_rating' => ['required', Rule::in(\App\Enums\AgeRatingEnum::cases())],

            'episodes_released' => ['required', 'integer', 'lte:episodes_total'],
            'episodes_total' => ['required', 'integer'],
            'duration' => ['required', 'integer'],
            'release' => ['required', 'date', 'after:1980-01-01|', 'before:2100-01-01'],
            'description' => ['nullable', 'string'],
            'status' => ['required', Rule::in(\App\Enums\StatusEnum::cases())],
            'is_comment' => ['nullable', 'string'],
            'is_rating' => ['nullable', 'string'],
        ];
    }

    public function messages()
    {
        return [
            'type.integer' => 'Необходимо заполнить Тип',
            'country.integer' => 'Необходимо заполнить Страну',
        ];
    }

}
