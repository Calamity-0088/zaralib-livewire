## Commands to run tests quickly
- `composer test` runs all PHPUnit tests.
- To run a single test file: `vendor/bin/phpunit tests/Unit/SomeTest.php`.

## Lint and typecheck order
- First run `composer lint` (pint). Then run `composer test`.

## Setup notes
- After cloning, run `composer install` then `composer setup` for full dev environment.

## Flux UI note
- Flux UI components need the `TALL` stack with Tailwind v4.


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