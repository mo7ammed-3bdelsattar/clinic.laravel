<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
  </a>
</p>

<p align="center">
  <a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
  <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
  <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
  <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

---

# vCare - Clinic Management System

**vCare** is a Clinic Management System built with **Laravel 10**.  
It helps manage doctors, patients, appointments, payments, and provides real-time communication between users.

---

## 🚀 Features
- Patients management.  
- Doctors management (with session pricing).  
- Appointments booking system.  
- Roles & permissions (Admin, Doctor, Patient).  
- Social login with Google/Facebook (via Socialite).  
- Real-time notifications & chat (Laravel Reverb + Pusher).  
- Multi-language support (Localization).  
- Payments through PayPal.  
- Toastr notifications for a better UX.  

---

## 🛠️ Tech Stack
- **Backend:** Laravel 10 (PHP 8.1+)  
- **Database:** MySQL  
- **Real-time:** Laravel Reverb + Pusher  
- **Authentication:** Laravel Sanctum + Socialite + Spatie Permissions  
- **UI Helpers:** LaravelCollective + Toastr  
- **Testing:** PHPUnit + Mockery  

---

## 📦 Main Packages
- `barryvdh/laravel-debugbar` → Debugging tool.  
- `beyondcode/laravel-query-detector` → Detect N+1 queries.  
- `fakerphp/faker` → Generate fake data.  
- `guzzlehttp/guzzle` → HTTP client for APIs.  
- `laravel/socialite` → OAuth login (Google, Facebook, etc).  
- `laravel/sanctum` → API authentication.  
- `spatie/laravel-permission` → Roles & permissions management.  
- `laravel/reverb` + `pusher/pusher-php-server` → Real-time WebSockets.  
- `srmklive/paypal` → PayPal integration.  
- `mcamara/laravel-localization` → Multi-language support.  
- `stichoza/google-translate-php` → Google Translate API.  
- `yoeunes/toastr` → Toastr.js notifications.  

---

## ⚙️ Installation
```bash
# 1. Clone the repository
git clone https://github.com/username/vcare.git
cd vcare

# 2. Install dependencies
composer install
npm install && npm run dev

# 3. Configure environment
cp .env.example .env
php artisan key:generate

# 4. Run migrations & seeders
php artisan migrate --seed

# 5. Start the development server
php artisan serve
