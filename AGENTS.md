## Commands

- `composer test` — full pipeline: `config:clear` → `lint:check` → PHPUnit
- `vendor/bin/phpunit tests/Unit/SomeTest.php` — single test file
- `composer lint` — auto-fix code style with Pint
- `composer lint:check` — check only (no fixes)
- `composer setup` — full new-dev setup: composer install, copy .env, key:generate, migrate, npm install, npm build
- `composer dev` — starts server + queue + logs + Vite concurrently
- `npm run build` / `npm run dev` — Vite build/dev

## Requirements & constraints

- PHP ^8.3, Node 22 (CI uses Node 22, PHP 8.4 & 8.5)
- **Flux UI requires paid credentials**: `composer config http-basic.composer.fluxui.dev "$FLUX_USERNAME" "$FLUX_LICENSE_KEY"`
- **Tests use in-memory SQLite** — no real DB needed
- **Tailwind v4**: configured via `@tailwindcss/vite` plugin only (no `tailwind.config.js`); CSS imported directly in Blade files

## Architecture

- **Stack**: Laravel 13 + Livewire 4 + Flux UI + Laravel Fortify (auth)
- **Livewire components**: `app/Livewire/` — standard class components (`Actions/`, `Settings/`)
- **Volt page components**: `resources/views/pages/` — anonymous class in Blade with `⚡` prefix, no corresponding PHP file; registered via `Route::livewire('/path', 'pages::name')`
- **Models**: `app/Models/User.php`, `app/Models/Manga.php`
- **Routes**: `routes/web.php` (mangas CRUD, auth), `routes/settings.php` (profile, appearance, security)
- **Tests**: `tests/Unit/`, `tests/Feature/`; `tests/TestCase.php` provides `skipUnlessFortifyHas()`
