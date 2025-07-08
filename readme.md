# Laravel Kurs - Comprehensive Web Development with Laravel

(https://www.udemy.com/certificate/UC-0056c288-96d3-47b9-9de0-c9ee412fbde6/)

This repository contains multiple Laravel projects created during a comprehensive Laravel development course. The course covers fundamental to advanced Laravel concepts through hands-on projects.

## 📁 Projects Overview

### 1. **Book Review** ([book-review/](book-review/))
A book review application demonstrating basic Laravel CRUD operations, user authentication, and review systems.

### 2. **Job Board** ([job-board/](job-board/))
A complete job board application featuring:
- Job listings with filtering by experience and category
- Employer and job seeker roles
- Job applications with file uploads
- Authorization policies using Laravel Gates and Policies
- Custom Blade components like [`BreadCrumbs`](job-board/app/View/Components/BreadCrumbs.php)

### 3. **Event Management** ([event-management/](event-management/))
An event management system showcasing advanced Laravel features and event handling.

### 4. **Livewire Poll** ([livewire-poll/](livewire-poll/))
Interactive polling application built with Laravel Livewire for real-time user interactions.

### 5. **Todo List** ([todo-list/](todo-list/))
A task management application covering basic Laravel operations and data relationships.

## 🎓 Key Concepts Learned

### Core Laravel Features
- **MVC Architecture** - Models, Views, Controllers
- **Eloquent ORM** - Database relationships and queries
- **Blade Templates** - Template engine with components and layouts
- **Routing** - Web routes and API endpoints
- **Middleware** - Request filtering and authentication
- **Form Validation** - Request validation classes
- **Database Migrations & Seeders** - Database version control

### Advanced Topics
- **Authentication & Authorization**
  - Laravel Sanctum for API authentication
  - Policies and Gates for authorization
  - User roles and permissions

- **File Handling**
  - File uploads and storage
  - CV/Resume upload functionality

- **Queue System**
  - Background job processing
  - Queue workers and job retries

- **Blade Components**
  - Custom reusable components
  - Component attributes and slots
  - Layout components

### Development Tools & Commands

Key Artisan commands learned (from [wichtiges_aus_dem_kurs.md](wichtiges_aus_dem_kurs.md)):

```bash
# Project Setup
composer create-project --prefer-dist laravel/laravel project-name
php artisan serve

# Database Operations
php artisan migrate
php artisan migrate:refresh --seed
php artisan db:seed
php artisan db:wipe

# Code Generation
php artisan make:controller BookController --resource
php artisan make:model Task -mfsc
php artisan make:factory TaskFactory --model=Task
php artisan make:request TaskRequest
php artisan make:policy AttendeePolicy --model=Attendee
php artisan make:component Layout --view

# Queue Management
php artisan queue:work --stop-when-empty
php artisan queue:work --tries=3 --timeout=60
php artisan queue:restart

# API Setup
php artisan install:api
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
```

### Docker Integration
The course included Docker setup for consistent development environments:
```bash
docker compose exec app bash
docker compose exec node npm run dev
```

## 🛠 Technical Stack

- **Backend**: PHP 8.x, Laravel Framework
- **Frontend**: Blade Templates, Tailwind CSS, Livewire
- **Database**: MySQL/PostgreSQL with Eloquent ORM
- **Development**: Docker, Composer, NPM/Vite
- **Authentication**: Laravel Sanctum
- **File Storage**: Laravel Storage system

## 📚 Project Features Implemented

### Job Board Highlights
- **Custom Blade Components**: Reusable UI components like job cards and breadcrumbs
- **Authorization**: Policy-based access control for job applications
- **File Uploads**: CV upload functionality for job applications
- **Filtering**: Advanced job filtering by experience, category, and location
- **Soft Deletes**: Job deletion with preservation of data integrity

### Common Patterns Across Projects
- **CRUD Operations**: Create, Read, Update, Delete functionality
- **Form Validation**: Server-side validation with custom request classes
- **Database Relationships**: One-to-many, many-to-many relationships
- **Factory & Seeding**: Test data generation for development
- **Component Architecture**: Reusable Blade components

## 🚀 Getting Started

Each project can be run independently. General setup process:

1. Clone the repository
2. Navigate to the desired project directory
3. Install dependencies: `composer install`
4. Configure environment: Copy `.env.example` to `.env`
5. Generate application key: `php artisan key:generate`
6. Run migrations: `php artisan migrate --seed`
7. Start development server: `php artisan serve`

## 📖 Learning Resources

This course covered Laravel's extensive ecosystem including:
- [Laravel Documentation](https://laravel.com/docs)
- [Laravel Bootcamp](https://bootcamp.laravel.com)
- [Laracasts Video Tutorials](https://laracasts.com)

---

*This repository represents a comprehensive journey through Laravel development, from basic MVC concepts to advanced features like queues, policies, and real-time interfaces