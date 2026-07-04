<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $userId = $this->user()->id;

        return [
            'name'   => ['required', 'string', 'max:255'],
            'email'  => ['required', 'email', Rule::unique('users', 'email')->ignore($userId)],
            'phone'  => ['nullable', 'string', 'max:20'],
            'avatar' => ['nullable', 'image', 'mimes:png,jpg,jpeg,webp', 'max:2048'],
        ];
    }
}
