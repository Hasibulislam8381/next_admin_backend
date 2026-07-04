<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\MailSettingRequest;
use App\Models\MailSetting;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\Mail;

class MailSettingController extends Controller
{
    use ApiResponse;

    // GET mail settings
    public function show()
    {
        $setting = MailSetting::first();

        return $this->success($setting, 'Mail settings fetched successfully');
    }

    // UPDATE mail settings
    public function update(MailSettingRequest $request)
    {
        $setting = MailSetting::first();

        if ($setting) {
            $setting->update($request->validated());
        } else {
            $setting = MailSetting::create($request->validated());
        }

        return $this->success($setting->fresh(), 'Mail settings updated successfully');
    }

    // TEST mail (connection thik ache kina check korar jonno)
    public function testMail(\Illuminate\Http\Request $request)
    {
        $request->validate([
            'test_email' => ['required', 'email'],
        ]);

        try {
            applyMailSettings(); // fresh config load

            Mail::raw('This is a test email from your Admin Dashboard.', function ($message) use ($request) {
                $message->to($request->test_email)
                    ->subject('Test Mail - Admin Dashboard');
            });

            return $this->success(null, 'Test mail sent successfully');
        } catch (\Exception $e) {
            return $this->error(null, 'Failed to send test mail: ' . $e->getMessage(), 500);
        }
    }
}
