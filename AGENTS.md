# AGENTS.md — api-todo-slim

## Dev commands

| Action | Command |
|---|---|
| Dev server | `composer start` (PHP built-in, port 8080) |
| Run all tests | `vendor/bin/phpunit` |
| Run unit tests only | `vendor/bin/phpunit --testsuite Unit` |
| Run integration tests only | `vendor/bin/phpunit --testsuite Integrations` |
| Docker up | `docker compose up` (app on :8090, PostgreSQL on :5432) |

## Architecture

- **Entrypoint:** `public/index.php` → `app/container.php` → `createContainer()` → `app/app.php` → `createApp()`
- **Routes:** `app/routes.php` auto-discovers and loads every `.php` file in `Routes/`. Each file returns a callable `function(App $app)`.
- **Container:** PHP-DI with definitions in `app/dependencies.php`. Config loaded from `.env` (production) or `.env.testing` (tests) via `vlucas/phpdotenv`.
- **Layers:** Routes → `Controllers` → `Services` → `Repositories` (interface-bound via `App\Contracts\Repository\TodoRepositoryInterface`).
- **Middleware:** `app/middleware.php` exists but is **not loaded** by the current bootstrap.

## Testing quirks

- `tests/TestCase.php` bootstraps a full Slim `App` instance with `createContainer(true)`, which activates `app/dependencies.testing.php`.
- `dependencies.testing.php` replaces `PostgresTodoRepository` with `Tests\Fakes\FakeTodoRepository` (in-memory, no database needed).
- Integration tests use `Slim\Psr7\Factory\ServerRequestFactory` to create PSR-7 requests and call `$this->app->handle($request)`.
- `phpunit.xml` sets `APP_ENV=testing`. The bootstrap also loads `.env.testing` if present.

## Database

- **Production:** PostgreSQL 13 via `PostgresTodoRepository` (uses `RETURNING id` syntax — PostgreSQL-specific). Requires `DB_*` env vars.
- **Tests:** No database. The fake repository is hardcoded to return one fixture todo.
- **Schema:** Table `todos` with columns `id` (serial PK), `title` (text), `completed` (boolean).

## Dead / unused code

- `src/Repositories/MemoryTodoRepository.php` — references stale namespace `App\Interfaces\TodoRepositoryInterface` (should be `App\Contracts\Repository`). Not wired in DI. Do not use without fixing.
- `app/middleware.php` — not loaded by current bootstrap.
- Config directory `config/` — empty placeholder.

## Tooling

- **No CI** (no `.github/` workflows).
- **No linter, formatter, or static analyser** configured (`.php-cs-fixer.cache` and `.pint.cache` are gitignored but no config files exist).
- **PHP 8.3+** required. Most source files use `declare(strict_types=1)`.
- **EditorConfig** at root: indent 4 spaces, LF line endings.
