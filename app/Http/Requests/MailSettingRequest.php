<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MailSettingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'mail_mailer'       => ['required', 'string', 'in:smtp,sendmail,mailgun,ses'],
            'mail_host'         => ['required', 'string', 'max:255'],
            'mail_port'         => ['required', 'numeric'],
            'mail_username'     => ['nullable', 'string', 'max:255'],
            'mail_password'     => ['nullable', 'string', 'max:255'],
            'mail_encryption'   => ['nullable', 'string', 'in:tls,ssl,null'],
            'mail_from_address' => ['required', 'email'],
            'mail_from_name'    => ['required', 'string', 'max:255'],
        ];
    }
}
