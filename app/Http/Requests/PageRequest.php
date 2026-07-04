<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // Update er somoy route theke page id ashbe (edit korar somoy nijer slug check theke bad dite)
        $pageId = $this->route('page');

        return [
            'title'        => ['required', 'string', 'max:255'],
            'page_content' => ['nullable', 'string'],
            'status'       => ['nullable', Rule::in(['published', 'draft'])],
        ];
    }
}
