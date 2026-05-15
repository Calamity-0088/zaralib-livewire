# AGENTS.md

## Dev Commands

```bash
# Full setup (installs deps, generates key, runs migrations, builds assets)
composer setup

# Run dev server with queue, logs, and vite
composer dev

# Lint (pint)
composer lint

# Run tests
composer test
# Or directly: ./vendor/bin/phpunit
```

## Key Constraints

- **Flux UI requires credentials**: Composer config `http-basic.composer.fluxui.dev` needs `FLUX_USERNAME` and `FLUX_LICENSE_KEY` secrets. CI adds these via `composer config http-basic.composer.fluxui.dev "$USER" "$KEY"`.

- **Tests use in-memory SQLite**: PHPUnit config sets `DB_CONNECTION=sqlite` and `DB_DATABASE=:memory:`. No actual database required for tests.

- **Tailwind v4**: Uses `@tailwindcss/vite` plugin, CSS is imported directly in Blade files (no traditional `resources/css/app.css`).

## Architecture

- Laravel 13 + Livewire 4 + Flux UI
- App root: `app/`
- Livewire components: `app/Livewire/`
- Models: `app/Models/`
- Test suites: `tests/Unit/`, `tests/Feature/`