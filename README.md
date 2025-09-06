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

```bash
composer install
npm install && npm run build
cp .env.example .env   # set DB credentials
php artisan key:generate
php artisan migrate
php artisan serve       # http://localhost:8000
npm run dev            # http://localhost:5173 (separate terminal)
```

## Quality & Tests
```bash
composer format
composer stan
composer test
composer peck
composer rector:dry
npm run test:e2e
```
