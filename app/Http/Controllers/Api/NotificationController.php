<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    use ApiResponse;

    // LIST all notifications (read + unread)
    public function index(Request $request)
    {
        $notifications = $request->user()
            ->notifications()
            ->latest()
            ->paginate(15);

        return $this->success($notifications, 'Notifications fetched successfully');
    }

    // UNREAD count (badge er jonno)
    public function unreadCount(Request $request)
    {
        $count = $request->user()->unreadNotifications()->count();

        return $this->success(['count' => $count], 'Unread count fetched');
    }

    // MARK single notification as read
    public function markAsRead(Request $request, $id)
    {
        $notification = $request->user()->notifications()->where('id', $id)->first();

        if (! $notification) {
            return $this->error(null, 'Notification not found', 404);
        }

        $notification->markAsRead();

        return $this->success(null, 'Notification marked as read');
    }

    // MARK all as read
    public function markAllAsRead(Request $request)
    {
        $request->user()->unreadNotifications->markAsRead();

        return $this->success(null, 'All notifications marked as read');
    }

    // DELETE single notification
    public function destroy(Request $request, $id)
    {
        $notification = $request->user()->notifications()->where('id', $id)->first();

        if (! $notification) {
            return $this->error(null, 'Notification not found', 404);
        }

        $notification->delete();

        return $this->success(null, 'Notification deleted successfully');
    }
}
