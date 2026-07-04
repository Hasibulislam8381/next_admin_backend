<div align="center">

# 🛠️ Admin Dashboard — Backend API

### Laravel 11 · Sanctum · RESTful API

A clean, modular, and secure REST API powering a professional admin dashboard system — built with scalability and developer experience in mind.

![Laravel](https://img.shields.io/badge/Laravel-11-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.2%2B-777BB4?style=for-the-badge&logo=php&logoColor=white)
![Sanctum](https://img.shields.io/badge/Auth-Sanctum-3ECF8E?style=for-the-badge&logo=laravel&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-Database-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![License](https://img.shields.io/badge/License-MIT-blue?style=for-the-badge)

</div>

---

## ✨ Features

- 🔐 **Token-based Authentication** — Secure login/logout via Laravel Sanctum
- ⚙️ **Dynamic System Settings** — Site title, logo, favicon, SEO metadata, copyright text, all editable at runtime
- 👤 **Profile Management** — Update personal info, avatar, and change password securely
- 📄 **Dynamic Pages (CRUD)** — Create unlimited custom pages with auto-generated unique slugs
- 🔔 **Database Notifications** — Built-in Laravel notification system with read/unread tracking
- 📧 **Dynamic Mail Configuration** — Configure SMTP settings from the database, with a built-in test-mail sender
- 📊 **Dashboard Analytics API** — Aggregated stats endpoint for pages, notifications, and recent activity
- 🧱 **Consistent API Responses** — Unified `ApiResponse` trait across all endpoints
- 🖼️ **Image Upload Handling** — Custom helpers for uploading, replacing, and deleting media files

---

## 🏗️ Tech Stack

| Layer          | Technology                  |
| -------------- | --------------------------- |
| Framework      | Laravel 11                  |
| Authentication | Laravel Sanctum (SPA/Token) |
| Database       | MySQL                       |
| API Style      | RESTful JSON API            |
| File Storage   | Public disk (local uploads) |

---

## 📁 Project Structure

```
app/
├── Http/
│   ├── Controllers/
│   │   └── Api/
│   │       ├── Auth/
│   │       │   └── AuthController.php
│   │       ├── SystemSettingController.php
│   │       ├── ProfileController.php
│   │       ├── PageController.php
│   │       ├── NotificationController.php
│   │       ├── MailSettingController.php
│   │       └── DashboardController.php
│   └── Requests/
│       ├── Auth/LoginRequest.php
│       ├── SystemSettingRequest.php
│       ├── UpdateProfileRequest.php
│       ├── ChangePasswordRequest.php
│       ├── PageRequest.php
│       └── MailSettingRequest.php
├── Models/
│   ├── User.php
│   ├── SystemSetting.php
│   ├── Page.php
│   └── MailSetting.php
├── Traits/
│   └── ApiResponse.php
└── Helpers/
    └── helpers.php
```

---

## 🚀 Getting Started

### Prerequisites

- PHP >= 8.2
- Composer
- MySQL
- Laravel CLI

### Installation

```bash
# Clone the repository
git clone <your-repo-url> admin-backend
cd admin-backend

# Install dependencies
composer install

# Environment setup
cp .env.example .env
php artisan key:generate

# Configure your database in .env
DB_DATABASE=admin_dashboard
DB_USERNAME=root
DB_PASSWORD=

# Run migrations
php artisan migrate

# Seed default admin user & settings
php artisan db:seed

# Create symlink for storage (optional, for legacy storage disk usage)
php artisan storage:link

# Serve the application
php artisan serve
```

The API will be available at `http://localhost:8000/api/admin`

---

## 🔑 Default Admin Credentials

| Field    | Value             |
| -------- | ----------------- |
| Email    | `admin@admin.com` |
| Password | `12345678`        |

> ⚠️ **Change these credentials immediately after first login in production.**

---

## 📡 API Endpoints Overview

| Module          | Endpoint                             | Method                            |
| --------------- | ------------------------------------ | --------------------------------- |
| Auth            | `/api/admin/login`                   | `POST`                            |
| Auth            | `/api/admin/logout`                  | `POST`                            |
| Auth            | `/api/admin/me`                      | `GET`                             |
| System Settings | `/api/admin/system-settings`         | `GET` / `POST`                    |
| Profile         | `/api/admin/profile`                 | `GET` / `POST`                    |
| Profile         | `/api/admin/profile/change-password` | `POST`                            |
| Pages           | `/api/admin/pages`                   | `GET` / `POST` / `PUT` / `DELETE` |
| Notifications   | `/api/admin/notifications`           | `GET`                             |
| Notifications   | `/api/admin/notifications/{id}/read` | `POST`                            |
| Mail Settings   | `/api/admin/mail-settings`           | `GET` / `POST`                    |
| Mail Settings   | `/api/admin/mail-settings/test`      | `POST`                            |
| Dashboard       | `/api/admin/dashboard/stats`         | `GET`                             |

All protected routes require a Bearer token obtained from `/login`.

---

## 🧩 Standard API Response Format

```json
{
    "status": true,
    "message": "Operation successful",
    "data": {},
    "code": 200
}
```

---

## 🔒 CORS Configuration

Update `config/cors.php` to allow your frontend origin:

```php
'allowed_origins' => ['http://localhost:3000'],
'supports_credentials' => true,
```

---

## 📄 License

This project is open-sourced software licensed under the [MIT license](LICENSE).

---

<div align="center">

Built with ❤️ using Laravel

</div>
