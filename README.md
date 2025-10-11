# I.E.T Government High School Management System

[![Laravel](https://img.shields.io/badge/Laravel-11.x-red.svg)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.2%2B-blue.svg)](https://php.net)

A comprehensive school management system built with Laravel for I.E.T Government High School, managing students, classes, attendance, and academic records.

## Features

-   **Admin Panel**: Manage students, classes, marks, and attendance
-   **Student Portal**: View class routine, marks, and attendance history
-   **Dashboard**: Real-time statistics and analytics
-   **Demo Data**: 120 sample students across 6 classes

## Tech Stack

-   Laravel 11.x
-   PHP 8.2+
-   Bootstrap 5
-   MySQL Database

## Installation

```bash
# Clone the repository
git clone https://github.com/niloy2107028/School-Management-System.git
cd School-Management-System

# Install dependencies
composer install
npm install && npm run build

# Setup environment
cp .env.example .env
php artisan key:generate

# Configure database in .env file
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=school_management
# DB_USERNAME=root
# DB_PASSWORD=your_password

# Setup database
php artisan migrate
php artisan db:seed

# Start server
php artisan serve
```

Visit `http://localhost:8000`

## Project Structure

```
├── app/Http/Controllers/    # Admin & Student controllers
├── resources/views/         # Blade templates
├── routes/web.php          # Application routes
└── database/               # Migrations & seeders
```

## Routes

**Admin**: `/admin/dashboard`, `/admin/students`, `/admin/classes`, `/admin/marks`, `/admin/attendance`

**Student**: `/student/dashboard`, `/student/routine`, `/student/marks`, `/student/attendance`

## Requirements

-   PHP 8.2+
-   Composer
-   Node.js & npm
-   MySQL 5.7+

## Contact

**Niloy**  
Email: niloy2107028@stud.kuet.ac.bd  
GitHub: [@niloy2107028](https://github.com/niloy2107028)

**Rokib**  
Email: islam2107008@stud.kuet.ac.bd

**Daud**  
Email: mdsharif.abudaud@gmail.com
# School-Management-System
