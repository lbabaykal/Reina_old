<?php /** @noinspection PhpInconsistentReturnPointsInspection */

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FolderDoramasRequest extends FormRequest
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
                'title' => ['required', 'string', 'min:2', 'max:255'],
            ];
        } elseif ($this->isMethod('PATCH')) {
            return [
                'title' => ['required', 'string', 'min:2', 'max:255'],
            ];
        }
    }

}
