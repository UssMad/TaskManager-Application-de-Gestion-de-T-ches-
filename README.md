<div align="center">

# 📝 TaskManager - Application de Gestion de Tâches

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)
![Alpine.js](https://img.shields.io/badge/Alpine.js-8BC0D0?style=for-the-badge&logo=alpine.js&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)

A professional, modern, and highly responsive Task Management web application built with **Laravel 13**, focusing on a minimalist and kinetic user interface.

</div>

---

## ✨ Features

- **🔐 Secure Authentication:** Full login, registration, and password reset functionalities powered by Laravel Breeze.
- **📋 Task Management (CRUD):** Create, read, update, and delete tasks seamlessly.
- **🎨 Kinetic Minimalist UI:** Premium visual aesthetic with dynamic moving backgrounds, glassmorphism effects, and smooth Alpine.js interactions.
- **📱 Fully Responsive:** Carefully crafted layouts that look perfect on desktops, tablets, and mobile devices.
- **🚀 Optimized Performance:** Built with modern tooling (Vite, TailwindCSS) for incredibly fast load times.

---

## 🛠️ Tech Stack

- **Backend:** PHP 8.3, Laravel 13.0
- **Frontend:** Blade Templates, Tailwind CSS, Alpine.js
- **Database:** MySQL
- **Build Tool:** Vite
- **Development & Debugging:** Laravel Telescope, Laravel Debugbar

---

## 📂 Project Structure

Here is the complete folder structure for the application:

```text
📦 TaskManager
├── 📂 app/                  # Core application logic
│   ├── 📂 Http/             # Controllers, Middleware, and Requests
│   │   ├── 📂 Controllers/  # Route logic (e.g., TaskController)
│   │   │   └── 📂 Auth/     # Authentication controllers
│   │   └── 📂 Requests/     # Form request validation
│   ├── 📂 Models/           # Eloquent Models (User, Task, etc.)
│   ├── 📂 Providers/        # Service providers for application bootstrapping
│   └── 📂 View/             # View components
│       └── 📂 Components/   # Blade UI components
├── 📂 bootstrap/            # Framework boot scripts and cache
│   └── 📂 cache/            # Framework optimization cache
├── 📂 config/               # Application configuration files
├── 📂 database/             # Database files
│   ├── 📂 factories/        # Model factories for testing (UserFactory, etc.)
│   ├── 📂 migrations/       # Database schema definitions
│   └── 📂 seeders/          # Database seed classes
├── 📂 public/               # Public-facing web root
│   ├── 📂 build/            # Compiled Vite assets
│   └── 📂 css/              # Static CSS files
├── 📂 resources/            # Uncompiled frontend assets
│   ├── 📂 css/              # Tailwind CSS entry points
│   ├── 📂 js/               # Application JavaScript / Alpine.js
│   └── 📂 views/            # Blade templates
│       ├── 📂 auth/         # Login, Register, Password Reset views
│       ├── 📂 layouts/      # App layout wrappers
│       ├── 📂 profile/      # User profile views
│       └── 📂 tasks/        # Task management views
│           └── 📂 partials/ # Reusable view fragments
├── 📂 routes/               # Route definitions (web.php, api.php, console.php)
├── 📂 tests/                # Automated tests
│   ├── 📂 Feature/          # Feature tests
│   └── 📂 Unit/             # Unit tests
├── 📄 .env                  # Environment configuration
├── 📄 composer.json         # PHP dependencies
├── 📄 package.json          # Node.js dependencies
├── 📄 tailwind.config.js    # Tailwind CSS configuration
└── 📄 vite.config.js        # Vite bundler configuration
```

---

## 🚀 Installation & Setup

Follow these steps to get the project up and running on your local machine:

**1. Clone the repository**
```bash
git clone <repository-url>
cd TaskManager-Application-de-Gestion-de-T-ches-
```

**2. Install PHP dependencies**
```bash
composer install
```

**3. Install NPM dependencies**
```bash
npm install
```

**4. Set up the Environment configuration**
Copy the example `.env` file and set up your MySQL database credentials:
```bash
cp .env.example .env
```
_Make sure to update `DB_DATABASE`, `DB_USERNAME`, and `DB_PASSWORD` in your `.env` file._

**5. Generate Application Key**
```bash
php artisan key:generate
```

**6. Run Database Migrations (and Seeders)**
```bash
php artisan migrate --seed
```

**7. Build Frontend Assets**
```bash
npm run build
# OR for development watching:
# npm run dev
```

**8. Start the Development Server**
```bash
php artisan serve
```

The application should now be running at `http://127.0.0.1:8000`.

---

## 📝 License

This project is open-source and available under the [MIT License](https://opensource.org/licenses/MIT).
