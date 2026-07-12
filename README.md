# Laravel E-commerce Admin

Backend and **admin / catalog-management system** for an e-commerce site, built with **Laravel 10**.
It handles the store's catalog and content administration — brands, categories, image galleries,
homepage sliders, and contact submissions — with authentication via **Laravel Jetstream**, running
on a **Docker + MySQL** stack.

> **Scope:** this repository implements the **admin/catalog-management backend** and the site's
> Blade views. The customer-facing storefront layout is template-based; product cart/checkout is
> not part of the backend feature set documented below.

## Stack

- **Laravel 10 (PHP)** — routing, controllers, Eloquent ORM, validation
- **Laravel Jetstream** — authentication (login, registration, email verification, 2FA, password management)
- **MySQL** — database
- **Docker / Docker Compose** — containerized development environment
- **Blade** — server-rendered views

## Features

**Catalog & content management (Eloquent CRUD)**
- **Categories** — create, edit, update, with **soft-delete, restore, and permanent-delete**
- **Brands** — full create / edit / update / delete
- **Image galleries** — single and **multi-image** upload management (`Multipic`)
- **Homepage sliders** — manage the storefront hero carousel
- **Homepage content** — editable home / about sections
- **Contact form** — database-backed contact submissions

**Authentication (Laravel Jetstream)**
- Registration, login, and email verification
- Two-factor authentication (2FA)
- Password change / management

## Technical highlights

- **Soft deletes with restore** on categories — records can be trashed, recovered, or permanently
  removed (Laravel `SoftDeletes`).
- **Named, RESTful routes** for every admin action (`all.category`, `store.brand`,
  `category.restore`, `home.slider`, …).
- **Image upload handling**, including multi-file galleries.
- **Containerized** for a reproducible local setup.

## Getting started (Docker)

```bash
# Clone
git clone git@github.com:zoma00/laravel-ecommerce-admin.git
cd laravel-ecommerce-admin

# Environment
cp .env.example .env

# Start containers
docker-compose up -d

# Install dependencies, generate app key, run migrations
docker exec app composer install
docker exec app php artisan key:generate
docker exec app php artisan migrate
```

**Database note:** migrations create the schema (tables) but no seed data. Add records through the
admin UI, or via an SQL client (DBeaver, MySQL Workbench) once the containers are running.

## Project structure

```
app/
  Models/             Brand, Category, Slider, Multipic, HomeAbout, Contact, User
  Http/Controllers/   Brand, Category, Home, About, Contact, ChangePass
database/migrations/  database schema
resources/views/      Blade templates
routes/web.php        admin + page routes
docker-compose.yml    Docker environment
```

## Author

Hazem Elbatawy — [contact@foliovistabooks.com](mailto:contact@foliovistabooks.com)
