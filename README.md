# Basic Laravel Ecommerce Project

<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
  </a>
</p>

## 📦 Overview

This is a basic **Ecommerce website** built with the **Laravel PHP framework**, structured to demonstrate backend development using:

- **PHP (Laravel)** – backend API, routing, controllers, authentication, and database logic.
- **Docker** – containerized development setup.
- **MySQL (or SQLite)** – as the database.
- **Git & GitHub** – for version control and remote collaboration.

It is a great starter template for small-to-medium ecommerce platforms.

---

## 🚀 Features

- User registration and login system
- Product listing and details
- Shopping cart functionality
- Order placement
- Admin dashboard (if implemented)
- Laravel MVC structure
- Docker environment for seamless setup

---

## 🐳 Getting Started with Docker

```bash
# Clone the repository
git clone git@github.com:zoma00/Basic-Laravel-Ecommerce-pro.git

cd Basic-Laravel-Ecommerce-pro

# Copy environment file
cp .env.example .env

# Start Docker containers
docker-compose up -d

# Install dependencies
docker exec app composer install

# Generate app key
docker exec app php artisan key:generate

# Run migrations
docker exec app php artisan migrate

# important Database Note:

The database is ready with tables established and migrated, but no data exists. To add data, use an SQL client (like Dbeaver, Mysql Workbench, etc.) after activating the Docker containers.
```



## 🧠 Credits

Created by **Hazem ElBatawy**
mailto:zoma0097@gmail.com

