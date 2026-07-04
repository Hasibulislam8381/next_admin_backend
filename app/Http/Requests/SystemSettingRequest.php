<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SystemSettingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'            => ['nullable', 'string', 'max:255'],
            'email'            => ['nullable', 'email', 'max:255'],
            'system_name'      => ['nullable', 'string', 'max:255'],
            'copyright_text'   => ['nullable', 'string', 'max:255'],
            'logo'             => ['nullable', 'image', 'mimes:png,jpg,jpeg,webp,svg', 'max:2048'],
            'favicon'          => ['nullable', 'image', 'mimes:png,ico,jpg,jpeg', 'max:1024'],
            'about_system'     => ['nullable', 'string'],
            'meta_title'       => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:500'],
            'meta_keywords'    => ['nullable', 'string', 'max:255'],
            'og_image'         => ['nullable', 'image', 'mimes:png,jpg,jpeg,webp', 'max:2048'],
        ];
    }
}
