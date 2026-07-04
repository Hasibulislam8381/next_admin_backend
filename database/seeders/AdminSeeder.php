<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\SystemSetting;
use App\Models\MailSetting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Admin user create (already thakle update, na thakle create)
        User::updateOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('12345678'),
                'email_verified_at' => now(),
            ]
        );

        // 2. Default system settings row (single row concept)
        SystemSetting::updateOrCreate(
            ['id' => 1],
            [
                'title' => 'Admin Dashboard',
                'email' => 'admin@admin.com',
                'system_name' => 'My System',
                'copyright_text' => '© ' . date('Y') . ' All Rights Reserved.',
                'about_system' => 'This is the admin dashboard system.',
            ]
        );

        // 3. Default mail settings row (single row concept)
        MailSetting::updateOrCreate(
            ['id' => 1],
            [
                'mail_mailer' => 'smtp',
                'mail_host' => 'smtp.mailtrap.io',
                'mail_port' => '2525',
                'mail_encryption' => 'tls',
                'mail_from_address' => 'admin@admin.com',
                'mail_from_name' => 'Admin Dashboard',
            ]
        );
    }
}
