<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\SystemSettingController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\PageController;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\MailSettingController;
use App\Http\Controllers\Api\DashboardController;

Route::prefix('admin')->name('admin.')->group(function () {

    // ---------- Public ----------
    Route::post('/login', [AuthController::class, 'login'])->name('login');

    // ---------- Protected ----------
    Route::middleware('auth:sanctum')->group(function () {

        // Auth (controller group)
        Route::controller(AuthController::class)->group(function () {
            Route::get('/me', 'me')->name('me');
            Route::post('/logout', 'logout')->name('logout');
        });

        // System Settings (controller group)
        Route::controller(SystemSettingController::class)->group(function () {
            Route::get('/system-settings', 'show')->name('system-settings.show');
            Route::post('/system-settings', 'update')->name('system-settings.update');
        });

        // Profile (controller group)
        Route::controller(ProfileController::class)->prefix('profile')->name('profile.')->group(function () {
            Route::get('/', 'show')->name('show');
            Route::post('/', 'update')->name('update');
            Route::post('/change-password', 'changePassword')->name('change-password');
        });
        Route::controller(PageController::class)->prefix('pages')->name('pages.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/', 'store')->name('store');
            Route::get('/{page}', 'show')->name('show');
            Route::put('/{page}', 'update')->name('update');
            Route::delete('/{page}', 'destroy')->name('destroy');
        });
        Route::controller(NotificationController::class)->prefix('notifications')->name('notifications.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/unread-count', 'unreadCount')->name('unread-count');
            Route::post('/{id}/read', 'markAsRead')->name('read');
            Route::post('/read-all', 'markAllAsRead')->name('read-all');
            Route::delete('/{id}', 'destroy')->name('destroy');
        });
        Route::controller(MailSettingController::class)->prefix('mail-settings')->name('mail-settings.')->group(function () {
            Route::get('/', 'show')->name('show');
            Route::post('/', 'update')->name('update');
            Route::post('/test', 'testMail')->name('test');
        });
        Route::get('/dashboard/stats', [DashboardController::class, 'stats'])->name('dashboard.stats');
    });
});
