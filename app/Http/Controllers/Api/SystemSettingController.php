<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SystemSetting;
use App\Http\Requests\SystemSettingRequest;
use App\Traits\ApiResponse;

class SystemSettingController extends Controller
{
    use ApiResponse;
    public function show()
    {
        $setting = SystemSetting::first();

        return $this->success($setting, 'System settings fetched successfully');
    }
    public function update(SystemSettingRequest $request)
    {
        $setting = SystemSetting::first();

        $data = $request->except(['logo', 'favicon', 'og_image']);

        // Logo upload
        if ($request->hasFile('logo')) {
            if ($setting && $setting->logo) {
                deleteImage($setting->logo);
            }
            $data['logo'] = uploadImage($request->file('logo'), 'system');
        }

        // Favicon upload
        if ($request->hasFile('favicon')) {
            if ($setting && $setting->favicon) {
                deleteImage($setting->favicon);
            }
            $data['favicon'] = uploadImage($request->file('favicon'), 'system');
        }

        // OG Image upload
        if ($request->hasFile('og_image')) {
            if ($setting && $setting->og_image) {
                deleteImage($setting->og_image);
            }
            $data['og_image'] = uploadImage($request->file('og_image'), 'system');
        }

        if ($setting) {
            $setting->update($data);
        } else {
            $setting = SystemSetting::create($data);
        }

        return $this->success($setting->fresh(), 'System settings updated successfully');
    }
}
