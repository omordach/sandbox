[![CI](https://github.com/omordach/sandbox/actions/workflows/ci.yml/badge.svg)](https://github.com/omordach/sandbox/actions/workflows/ci.yml)
# README

## Getting Started (Docker)

```bash
cp .env.docker .env
make up
make migrate
```

App: http://localhost:8080  
HMR: http://localhost:5173

## Getting Started (Non‑Docker)

```bash
composer install
npm ci
cp .env.example .env   # set DB credentials
php artisan key:generate
php artisan migrate
php artisan serve
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
