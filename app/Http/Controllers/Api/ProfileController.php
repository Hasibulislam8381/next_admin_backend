<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\ChangePasswordRequest;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    use ApiResponse;

    // GET own profile
    public function show(Request $request)
    {
        return $this->success($request->user(), 'Profile fetched successfully');
    }

    // UPDATE profile info
    public function update(UpdateProfileRequest $request)
    {

        $user = $request->user();

        $data = $request->only(['name', 'email', 'phone']);

        // Avatar upload
        if ($request->hasFile('avatar')) {
            if ($user->avatar) {
                deleteImage($user->avatar);
            }
            $data['avatar'] = uploadImage($request->file('avatar'), 'avatars');
        }

        $user->update($data);

        return $this->success($user->fresh(), 'Profile updated successfully');
    }

    // CHANGE password
    public function changePassword(ChangePasswordRequest $request)
    {
        $user = $request->user();

        if (! Hash::check($request->current_password, $user->password)) {
            return $this->error(null, 'Current password is incorrect', 422);
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        // Security best practice: password change korle purano sob token revoke,
        // shudhu current session active thakbe
        $currentTokenId = $user->currentAccessToken()->id;
        $user->tokens()->where('id', '!=', $currentTokenId)->delete();

        return $this->success(null, 'Password changed successfully');
    }
}
