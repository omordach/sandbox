![CI](https://github.com/omordach/sandbox/actions/workflows/ci.yml/badge.svg)

# Profile + Certifications (Laravel 11, Filament 3, Vue 3)

A simple site that shows a profile block and a public list of certifications. Certifications are managed in a Filament admin panel and support embedded Credly iframes.

## Tech Stack
- PHP 8.3, Laravel 11
- Filament 3 (admin at `/admin`)
- Vue 3 + Vite (non‑SPA boot, small components)
- Tailwind CSS
- Pest for tests
- SQLite (default) or MySQL/PostgreSQL

## Features
- Public pages:
  - `/` Home: profile info + top 6 certifications
  - `/certifications`: paginated list of published certifications
  - `/certifications/{slug}`: certification detail with sanitized Credly embed
- Filament admin:
  - Manage certifications (CRUD) with reorderable list by `sort_order`
  - “Fetch embed” button that converts a Credly badge URL into a standard iframe
- Sanitization: Only an `<iframe>` with a safe set of attributes is stored/rendered
- SEO basics: page titles and meta descriptions

## Requirements
- PHP 8.3+ with the DOM extension enabled (`ext-dom`)
- Composer
- Node.js 18+ and npm
- SQLite or another database (MySQL/PostgreSQL)

## Quick Start (Local, SQLite)
1) Copy env and set app key
```bash
cp .env.example .env
php artisan key:generate
```

2) Use SQLite (recommended for local)
```bash
# In .env set:
# DB_CONNECTION=sqlite
# Comment out all other DB_* lines

# Create the database file
mkdir -p database && touch database/database.sqlite
```

3) Install dependencies
```bash
composer install
npm install
```

4) Migrate and seed demo data
```bash
php artisan migrate --seed
```

5) Run the app and Vite
```bash
php artisan serve       # http://127.0.0.1:8000
npm run dev             # Vite HMR at http://localhost:5173
```

6) Log into Filament admin
- URL: `http://127.0.0.1:8000/admin`
- Demo user (seeded): `test@example.com` / `password`

## Alternative: MySQL/PostgreSQL
Update `.env` accordingly, for example (MySQL):
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=app
DB_USERNAME=root
DB_PASSWORD=secret
```
Then run:
```bash
php artisan migrate --seed
```

## Usage Guide
- Home shows your profile block from `config/profile.php` and up to 6 published certifications.
- Admin (Filament):
  - Create a Certification with Title, Issuer, Issued date, etc.
  - Paste a Credly public badge URL (e.g. `https://www.credly.com/badges/<uuid>/public_url`).
  - Click “Fetch embed” to auto‑generate the sanitized iframe.
  - Toggle Published and adjust Sort order.

## Customization
- Profile content: `config/profile.php`
- Views:
  - Layout: `resources/views/layouts/app.blade.php`
  - Home: `resources/views/home.blade.php`
  - Index: `resources/views/certifications/index.blade.php`
  - Detail: `resources/views/certifications/show.blade.php`
- Vue boot: `resources/js/app.ts`
- Copy link component: `resources/js/components/CopyLink.vue`

## Testing
```bash
php artisan test
```
Notes:
- Tests disable Vite asset injection to avoid manifest lookups in CI.

## Troubleshooting
- Missing DOM extension: install/enable `ext-dom` for PHP (required for embed sanitization).
- “Unable to locate file in Vite manifest”: ensure `npm run dev` is running (for browsing). Tests already bypass this.
- SQLite path issues: ensure `database/database.sqlite` exists and `.env` is set to `DB_CONNECTION=sqlite`.

## Docker (Optional)
If you prefer Docker and the included `Makefile`:
```bash
cp .env.example .env
make up
make php ARGS="composer install"
make npm ARGS="ci"
php artisan key:generate
php artisan migrate --seed
```
App: http://localhost:8080, Vite HMR: http://localhost:5173
