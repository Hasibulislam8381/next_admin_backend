<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    use ApiResponse;

    public function stats(Request $request)
    {
        $user = $request->user();

        $data = [
            'total_pages'        => Page::count(),
            'published_pages'    => Page::where('status', 'published')->count(),
            'draft_pages'        => Page::where('status', 'draft')->count(),
            'unread_notifications' => $user->unreadNotifications()->count(),
            'total_notifications'  => $user->notifications()->count(),
            'recent_pages'        => Page::latest()->take(5)->get(['id', 'title', 'status', 'created_at']),
        ];

        return $this->success($data, 'Dashboard stats fetched successfully');
    }
}
