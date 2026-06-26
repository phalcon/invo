# INVO Application

[Phalcon](https://phalcon.io) is a full-stack PHP framework delivered as a C
extension (v5) and, from v6, as a pure-PHP package. INVO is a sample invoicing
application that showcases the framework.

## Requirements

* Docker + Docker Compose (recommended), or
* PHP >= 8.2 with the Phalcon v5 extension (or the `phalcon/phalcon` v6 package) and MySQL >= 8.0

## Quick start (Docker)

```shell
cp .env.example .env
docker compose up -d --build
```

The app is served at http://localhost:8080 (override with `APP_PORT` in `.env`).
The database schema and seed data are applied automatically on container start.

Open a shell in the container:

```shell
docker compose exec app bash
```

### Phalcon v5 (default) or v6

The image is parameterized by `PHALCON_VARIANT`:

* `v5` (default) — installs the Phalcon C extension from source via PIE.
* `v6` — runs on the `phalcon/phalcon` package (no extension).

```shell
PHALCON_VARIANT=v6 docker compose up -d --build
```

Select the PHP version with `PHP_VERSION` (default `8.5`; supported `8.2`–`8.5`).

## Default login

The seeded demo account is **`demo`** / **`phalcon`**.

## Composer scripts

Run them inside the container, e.g. `docker compose exec app composer test`.

| Script | Purpose |
|---|---|
| `composer migrate` | Run database migrations (`phalcon/migrations`) |
| `composer test` | Run all Codeception suites |
| `composer test-unit` / `test-functional` / `test-acceptance` | Run one suite |
| `composer cs` / `cs-fix` | PHP_CodeSniffer check / fix (PSR-12) |
| `composer cs-fixer` / `cs-fixer-fix` | PHP CS Fixer check / fix |
| `composer analyze` | PHPStan static analysis |

## Design exports

`design/` contains a static HTML snapshot of every page the app renders,
suitable for UI-refresh work.

## Contributing

See [CONTRIBUTING.md](CONTRIBUTING.md).

## License

INVO is open-sourced software licensed under the [New BSD License](LICENSE).
© Phalcon Framework Team and contributors
