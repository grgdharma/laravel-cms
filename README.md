# 🚀 Laravel CMS

A Laravel-based Content Management System (CMS) built specifically for blogging, designed to help manage blog posts, categories, and more.
This guide provides complete installation steps to run the project locally.

---

## 🛠 Server Requirements

Ensure your system meets the following versions:

- **PHP:** 8.1.17  
- **Node.js:** v14.17.3  
- **Composer:** Latest version  
- **MySQL:** 5.7+ / MariaDB

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
- http://localhost/admin/login
- Default Login Credentials
- Email: gurungdrg30@gmail.com
- Password: BestAdmin@2022





