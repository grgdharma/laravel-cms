# 🚀 Laravel CMS

A Laravel-based Content Management System (CMS) built specifically for blogging, designed to help manage blog posts, categories, and more.
This guide provides complete installation steps to run the project locally.

<img width="2710" height="1567" alt="image" src="https://github.com/user-attachments/assets/a3d17b93-409c-42e7-8536-81e3fdd612ac" />

Admin Login
<img width="2581" height="1542" alt="image" src="https://github.com/user-attachments/assets/6b7d150f-4a42-427c-b3a7-eab48b0fa932" />

Admin Dashboard
<img width="2439" height="1332" alt="image" src="https://github.com/user-attachments/assets/190b33ab-50cf-4ec6-99dd-ffe2e6461a1b" />

---

## 🛠 Server Requirements

Ensure your system meets the following versions:

- **Minimum PHP version:** 8.1
- **Composer:** Latest version  
- **MySQL:** 5.7+ 

---

## 📦 Installation Guide

Follow the steps below to set up the project on your local environment.

---

### 1. Clone the Repository

- git clone < repository-url >

### 2. Create a new database
- Open your database management tool (e.g., phpMyAdmin).
- Create a new database.
- Create .env File by copying the example environment file.
- Update your .env file with the new database name.

### 3. Install Composer Dependencies
- composer install

### 4. Generate Application Key
- php artisan key:generate

### 5. Clear Cache
- php artisan optimize:clear

### 6. Migrate Database Tables
- php artisan migrate

### 7. Run Seeder (Fresh Migration + Seed)
- php artisan migrate:fresh --seed

### 8. Start Development Server
- php artisan serve

### 9. Access Admin Panel
- http://localhost:8000/admin/login
- Default Login Credentials
- Email: gurungdrg30@gmail.com
- Password: laravel-cms@2022





