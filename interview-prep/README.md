# Laravel Interview Prep Repository

![MIT License](https://img.shields.io/badge/license-MIT-green)
![Laravel Repo](https://img.shields.io/badge/Laravel-Repo-blue)

Welcome to the **Laravel Interview Prep Repository**! This repository is structured to help you understand and practice essential Laravel concepts in preparation for technical interviews. It includes examples, best practices, and explanations for core concepts and implementations in Laravel.

## Table of Contents
- [Overview](#overview)
- [Getting Started](#getting-started)
  - [Fork This Repository](#fork-this-repository)
  - [Installation](#installation)
- [Core Laravel Concepts](#core-laravel-concepts)
  - [Project Structure](#project-structure)
  - [Routing](#routing)
  - [Middleware](#middleware)
  - [Controllers and Resource Controllers](#controllers-and-resource-controllers)
  - [Blade Templating](#blade-templating)
  - [Models and Eloquent ORM](#models-and-eloquent-orm)
  - [Validation](#validation)
  - [Service Providers](#service-providers)
- [License](#license)

---

## Overview

This repository is designed to provide in-depth examples of **Laravel’s most important concepts**. Each concept is implemented as a separate example in the repository to make it easy to understand and apply in real-world situations. The repository assumes some familiarity with PHP but provides detailed explanations where needed.

### Project Goals
- **Prepare for Laravel interviews** by practicing core concepts.
- **Understand best practices** in building secure, scalable applications with Laravel.
- **Enhance PHP OOP knowledge** through Laravel’s object-oriented features.

---

## Getting Started

To start using this repo, **fork it**, clone it, and install the necessary dependencies. Or live at: <https://lavarel-deveric-6e99878107dc.herokuapp.com/>

### Fork This Repository
1. **Fork** the repository by clicking the “Fork” button at the top of this page.
2. Clone your forked repository locally:
   ```bash
   git clone https://github.com/YOUR_USERNAME/laravel-interview-prep.git
   cd laravel-interview-prep

### Installation
Install dependencies using Composer:

```bash
    composer install
```    
Copy the .env.example file to .env and generate an application key:

```bash
    cp .env.example .env
    php artisan key:generate
```
**Run migrations**:

```bash
    php artisan migrate
```

**Start the development server**

```bash
    php artisan serve
```

### Core Laravel Concepts
This section contains details on core Laravel concepts with examples included in this repository to help you gain a deeper understanding of each area. These concepts are divided by sections and structured in the repo for easy navigation.

1. **Project Structure**
Laravel’s directory structure is organized by core functionality, which makes it easy to navigate and manage even large applications. In this repo:

app/ - Core application code, including Models, Controllers, and Services.
routes/ - Application routes are defined here. web.php contains web routes, while api.php contains routes for API.
resources/views/ - Contains Blade templating files.

2. **Routing**
Routing in Laravel defines how URLs map to controller actions. This repo includes:

**Basic routes using closures**.
Route groups for grouping related routes with common attributes.
Route model binding to automatically inject model instances.

Example:

```php
    // Basic route
    Route::get('/home', [HomeController::class, 'index']);

    // Route model binding
    Route::get('/user/{user}', [UserController::class, 'show']);
```

3. **Middleware**
Middleware in Laravel provides a way to filter HTTP requests entering your application. In this repo, we’ve used middleware for:

3.1 **Authentication (using auth middleware)**.
Custom middleware for logging request data.

Example:

```bash
    php artisan make:middleware CheckUserRole
```

// Register in kernel
protected $routeMiddleware = [
    'role' => \App\Http\Middleware\CheckUserRole::class,
];

4. **Controllers and Resource Controllers**
Controllers in Laravel help organize application logic. This repo demonstrates:

Basic controllers for handling user requests.
Resource controllers with RESTful actions for CRUD operations.

Example:

```bash
    // Resource controller
    php artisan make:controller ProductController --resource
```

// Route
Route::resource('products', ProductController::class);


5. **Blade Templating**
Blade is Laravel's powerful templating engine. This repo covers:

Layout inheritance using @extends, @section, and @yield.
Blade components to create reusable UI components.
Example:

```html
    <!-- Layout file Using Blade-->
    <!DOCTYPE html>
    <html>
    <head>
        <title>@yield('title')</title>
    </head>
    <body>
        @yield('content')
    </body>
    </html>

    <!-- View file -->
    @extends('layouts.app')
    @section('title', 'Home')
    @section('content')
        <h1>Welcome to Home</h1>
    @endsection
```
6. **Models and Eloquent ORM**
Eloquent, Laravel’s ORM, is used for database interaction. In this repo:

Defining models and relationships (e.g., one-to-many, many-to-many).
Eloquent queries for CRUD operations.
Example:

```php
    // One-to-many relationship
    class User extends Model {
        public function posts() {
            return $this->hasMany(Post::class);
        }
    }
```
7. **Validation**
Laravel provides a simple way to validate incoming HTTP requests. This repo covers:

Request validation using FormRequest.
Custom validation rules for more complex requirements.
Example:

```php
    // Request validation
    $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required'
    ]);
```
8. **Service Providers**
Service Providers in Laravel are used for bootstrapping services. In this repo, service providers are used to:

Register services like payment or logging services.
Customize application bootstrapping by registering custom components.

Example:

```php
    // Register in AppServiceProvider
    public function register() {
        $this->app->singleton(MyService::class, function ($app) {
            return new MyService();
        });
    }
```
## License

This project is open-sourced under the **MIT License**.

---

## Contributing

Contributions are welcome! If you’d like to improve the examples or add new concepts to this repository, please follow these steps:

1. **Fork** the repository.
2. **Clone** your forked repository locally:
```bash
    git clone https://github.com/YOUR_USERNAME/laravel-interview-prep.git
    cd laravel-interview-prep
 ```
3. Create a new branch for your changes:
```bash
    git checkout -b feature/new-concept
```
4. Make your updates and commit:
```bash
    git add .
    git commit -m "Add new concept: [describe the concept]"
```
5. Push your changes:
```bash
    git push origin feature/new-concept
```
6. Open a Pull Request on the original repository.

**Contact**
For any questions, please reach out to the repository maintainer - Eric Gitangu

