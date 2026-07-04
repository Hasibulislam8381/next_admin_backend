<?php

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Config;
use App\Models\MailSetting;

if (! function_exists('uploadImage')) {
    function uploadImage($file, $folder)
    {
        if (! $file->isValid()) {
            return null;
        }

        $imageName = Str::slug(time()) . rand() . '.' . $file->extension();
        $path = public_path('uploads/' . $folder);

        if (! file_exists($path)) {
            mkdir($path, 0755, true);
        }

        $file->move($path, $imageName);

        return 'uploads/' . $folder . '/' . $imageName;
    }
}

if (! function_exists('applyMailSettings')) {
    function applyMailSettings()
    {
        $setting = MailSetting::first();

        if (! $setting) {
            return;
        }

        Config::set('mail.default', $setting->mail_mailer);
        Config::set('mail.mailers.smtp.host', $setting->mail_host);
        Config::set('mail.mailers.smtp.port', $setting->mail_port);
        Config::set('mail.mailers.smtp.username', $setting->mail_username);
        Config::set('mail.mailers.smtp.password', $setting->mail_password);
        Config::set('mail.mailers.smtp.encryption', $setting->mail_encryption);
        Config::set('mail.from.address', $setting->mail_from_address);
        Config::set('mail.from.name', $setting->mail_from_name);
    }
}

if (! function_exists('deleteImage')) {
    function deleteImage($relativePath)
    {
        if ($relativePath && file_exists(public_path($relativePath))) {
            unlink(public_path($relativePath));
            return true;
        }
        return false;
    }
}

if (! function_exists('imageUrl')) {
    function imageUrl($relativePath)
    {
        return $relativePath ? asset($relativePath) : null;
    }
}
