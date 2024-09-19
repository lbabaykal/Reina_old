<?php

namespace App\Http\Requests\AdminPanel;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EpisodeStoreRequest extends FormRequest
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
            'number' => ['required', 'integer'],
            'title_org' => ['required', 'string', 'min:1', 'max:255'],
            'title_ru' => ['required', 'string', 'min:1', 'max:255'],
            'title_en' => ['required', 'string', 'min:1', 'max:255'],
            'status' => ['required', Rule::in(\App\Enums\StatusEnum::cases())],
            'note' => ['nullable', 'string'],
            'release_date' => ['required', 'date'],
        ];
    }

}
