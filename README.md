[![CI](https://github.com/omordach/sandbox/actions/workflows/ci.yml/badge.svg)](https://github.com/omordach/sandbox/actions/workflows/ci.yml)
# README

## Getting Started (Docker)

```bash
cp .env.example .env
# DB_CONNECTION=pgsql
# DB_HOST=db
# DB_PORT=5432
# DB_DATABASE=app
# DB_USERNAME=app
# DB_PASSWORD=app
make up
make php ARGS="composer install"
make npm ARGS="ci"
make php ARGS="artisan key:generate"
make migrate
```

App: http://localhost:8080
HMR: http://localhost:5173

## Getting Started (Non‑Docker)
Follow these steps to set up and run the application on your machine without
Docker.

1. **Install prerequisites**
   * PHP 8.3+
   * [Composer](https://getcomposer.org/)
   * Node.js 18+ and npm
   * A running database (PostgreSQL, MySQL, etc.)
2. **Install PHP dependencies**
   ```bash
   composer install
   ```
3. **Install JavaScript dependencies**
   ```bash
   npm install
   ```
4. **Build frontend assets (optional for development)**
   ```bash
   npm run build
   ```
5. **Copy the example environment file and configure credentials**
   ```bash
   cp .env.example .env
   # edit .env to match your local database settings
   ```
6. **Generate the application key**
   ```bash
   php artisan key:generate
   ```
7. **Run database migrations**
   ```bash
   php artisan migrate
   ```
8. **Start the backend server**
   ```bash
   php artisan serve
   ```
   Visit http://localhost:8000
9. **Start the Vite development server in a separate terminal**
   ```bash
   npm run dev
   ```
   Hot Module Replacement: http://localhost:5173

## Quality & Tests
```bash
composer format
composer stan
composer test
composer peck
composer rector:dry
npm run test:e2e
```
