# INVO

[![Latest Version][packagist-version-badge]][packagist-version-link]
[![PHP Version][php-version-badge]][packagist-version-link]
[![Total Downloads][packagist-downloads-badge]][packagist-downloads-link]
[![License][license-badge]][license-link]

[![Invo CI][invo-ci-badge]][invo-ci-link]
[![Quality Gate Status][sonar-quality-badge]][sonar-link]
[![Coverage][sonar-coverage-badge]][sonar-link]
[![PDS Skeleton][pds-skeleton-badge]][pds-skeleton-link]

[![Discord][discord-badge]][discord-link]
[![Contributors][contributors-badge]][contributors-link]
[![OpenCollective Backers][oc-backers-badge]][oc-backers-link]
[![OpenCollective Sponsors][oc-sponsors-badge]][oc-sponsors-link]

INVO is the sample invoicing application for the [Phalcon Framework](https://github.com/phalcon/cphalcon).
It showcases CRUD management (companies, products, product types, invoices), forms,
ACL-based access control and session authentication.

It runs on **Phalcon v5** (the C extension, default) and on **Phalcon v6**
(the `phalcon/phalcon` package, currently alpha) from the same source.

## Requirements

* PHP 8.2 – 8.5
* MySQL 8.0 (provided by the Docker stack)
* Docker + Docker Compose (recommended), or a local PHP with the Phalcon extension

## Quick start (Docker)

```bash
cp .env.example .env
docker compose up -d --build

# Create the database schema (migrations are not run on boot)
docker compose exec app composer migrate
```

> **Note:** `app` is the Compose *service* name, used as-is by `docker compose exec` above. The
> running container, however, is named `${PROJECT_PREFIX}-app` - `invo-app` by default, set via
> `PROJECT_PREFIX` in `.env`. If you address it with plain `docker exec`, type your container name
> instead, e.g. `docker exec invo-app composer migrate` (substitute your own prefix).

Then open <http://localhost:8080> (override the host port with `APP_PORT` in `.env`).

Log in with the seeded demo account: **`demo`** / **`phalcon`**.

### Choosing the Phalcon version

```bash
docker compose up -d --build                      # v5 (C extension, default)
PHALCON_VARIANT=v6 docker compose up -d --build   # v6 (phalcon/phalcon, alpha)
```

The two are mutually exclusive: the v5 image installs the C extension, the v6 image
installs the pure-PHP package instead.

### Choosing the PHP version

The image is built for one PHP version at a time, selected with the `PHP_VERSION`
build arg (default `8.5`; supported `8.2`–`8.5`):

```bash
docker compose up -d --build                  # PHP 8.5 (default)
PHP_VERSION=8.2 docker compose up -d --build  # PHP 8.2
PHP_VERSION=8.3 docker compose up -d --build  # PHP 8.3
PHP_VERSION=8.4 docker compose up -d --build  # PHP 8.4
```

PIE compiles the Phalcon C extension (and pcov) from source for the selected version.
The container keeps the same name (`invo-app`), so each rebuild **replaces** the
previous one. To run several versions side by side, give each its own Compose project
and prefix:

```bash
PHP_VERSION=8.2 PROJECT_PREFIX=invo82 docker compose -p invo82 up -d --build
# then: docker exec -w /srv invo82-app composer test
```

## Quick start (Composer)

Prefer a local PHP over Docker? Bootstrap a fresh copy straight from Packagist:

```bash
composer create-project phalcon/invo invo
cd invo
```

The post-create hook copies `.env.example` to `.env` and prints the next steps.
Out of the box the app runs on the bundled `phalcon/phalcon` (v6) package - no
extension needed. To run on the Phalcon v5 C extension instead, install it with
[PIE](https://github.com/php/pie), the official PHP extension installer (unlike
pecl, it builds from source and supports current PHP versions):

```bash
curl -fsSL https://github.com/php/pie/releases/latest/download/pie.phar -o pie.phar
sudo php pie.phar install phalcon/cphalcon:^5.0
php -m | grep -i phalcon
```

Once the extension is loaded, PHP prefers it automatically and the bundled v6
package is simply shadowed - it can stay installed. Point `.env` at your MySQL,
then `composer migrate`, serve `public/`, and run the suites with
`vendor/bin/talon run`.

## Composer scripts

Run them inside the container, e.g. `docker compose exec app composer cs`:

| Script | Description |
| --- | --- |
| `composer cs` | PHP_CodeSniffer (PSR-12) |
| `composer cs-fix` | Auto-fix coding standard issues (phpcbf) |
| `composer cs-fixer` | PHP CS Fixer (dry-run) |
| `composer cs-fixer-fix` | Apply PHP CS Fixer |
| `composer analyze` | PHPStan static analysis |
| `composer test` | PHPUnit suites (unit, functional) via `vendor/bin/talon` |
| `composer test-coverage` | PHPUnit + Clover coverage (`tests/_output/coverage.xml`) |
| `composer migrate` | Run database migrations (`phalcon/migrations`) |

> `composer analyze` resolves Phalcon classes from the `phalcon/phalcon` (v6) source,
> so run it where the v5 C extension is **not** loaded (the CI `quality` job, or a plain
> host). The coding-standard and test scripts are unaffected.

## Running the tests

The suite is split into two PHPUnit testsuites - `unit` and `functional`. The functional
tests dispatch the application in-process through [`phalcon/talon`](https://github.com/phalcon/talon),
so no web server is needed.

```bash
docker compose up -d --build
docker compose exec app composer migrate          # once - create the schema

docker compose exec app composer test             # the full suite
docker compose exec app composer test-coverage    # + Clover coverage in tests/_output
```

### Test secrets

The test configuration lives in `tests/.env.test` and is loaded automatically by
`tests/bootstrap.php` - you do not need to supply anything by hand:

| Variable | Value | Purpose |
| --- | --- | --- |
| `DB_USERNAME` / `DB_PASSWORD` | `root` / `secret` | matches the MySQL container's root password |
| `DB_NAME` | `invo` | the migrated test database |

`tests/.env.test` is loaded with Dotenv's immutable loader, so any variable already set in the
environment takes precedence - the same suite runs unchanged inside Docker (service-name host
`mysql`) and on a native host or in CI (loopback `127.0.0.1`). The only secret that is **not**
local is `SONAR_TOKEN`, a GitHub Actions secret used solely by the `sonarqube` job.

## Updating Phalcon

* **v5** - bump `PHALCON_V5_CONSTRAINT` in `resources/docker/Dockerfile` and rebuild:
  `docker compose build app`. PIE compiles the C extension from source (this is the only
  way to update a C extension).
* **v6** - `docker compose exec app composer update phalcon/phalcon` (no rebuild).
  Dependabot opens the bump PR automatically.

## Project layout

Follows the [PDS skeleton](https://github.com/php-pds/skeleton):

```
config/     application configuration
public/     web server root
resources/  tooling configs, docker, migrations
src/        application source
tests/      PHPUnit suites (unit, functional)
themes/     Volt views
var/        runtime cache and logs
```

## Contributing

See [CONTRIBUTING.md](CONTRIBUTING.md).

## License

INVO is open-sourced software licensed under the New BSD License. See [LICENSE](LICENSE).

<!-- Badges -->
[packagist-version-badge]:   https://img.shields.io/packagist/v/phalcon/invo?include_prereleases&style=flat-square&logo=packagist&logoColor=white
[packagist-version-link]:    https://packagist.org/packages/phalcon/invo
[packagist-downloads-badge]: https://img.shields.io/packagist/dt/phalcon/invo?style=flat-square&logo=packagist&logoColor=white
[packagist-downloads-link]:  https://packagist.org/packages/phalcon/invo/stats
[php-version-badge]:         https://img.shields.io/packagist/php-v/phalcon/invo?style=flat-square&logo=php&logoColor=white
[license-badge]:             https://img.shields.io/github/license/phalcon/invo?style=flat-square&logo=opensourceinitiative&logoColor=white
[license-link]:              https://github.com/phalcon/invo/blob/master/LICENSE
[invo-ci-badge]:             https://github.com/phalcon/invo/actions/workflows/main.yml/badge.svg?branch=master
[invo-ci-link]:              https://github.com/phalcon/invo/actions/workflows/main.yml
[sonar-quality-badge]:       https://sonarcloud.io/api/project_badges/measure?project=phalcon_invo&metric=alert_status
[sonar-coverage-badge]:      https://sonarcloud.io/api/project_badges/measure?project=phalcon_invo&metric=coverage
[sonar-link]:                https://sonarcloud.io/summary/new_code?id=phalcon_invo
[pds-skeleton-badge]:        https://img.shields.io/badge/pds-skeleton-blue.svg?style=flat-square
[pds-skeleton-link]:         https://github.com/php-pds/skeleton
[discord-badge]:             https://img.shields.io/discord/310910488152375297?label=Discord&logo=discord&style=flat-square
[discord-link]:              https://phalcon.io/discord
[contributors-badge]:        https://img.shields.io/github/contributors/phalcon/invo?style=flat-square&logo=github&logoColor=white
[contributors-link]:         https://github.com/phalcon/invo/graphs/contributors
[oc-backers-badge]:          https://img.shields.io/opencollective/backers/phalcon?style=flat-square&logo=opencollective&logoColor=white
[oc-backers-link]:           https://opencollective.com/phalcon
[oc-sponsors-badge]:         https://img.shields.io/opencollective/sponsors/phalcon?style=flat-square&logo=opencollective&logoColor=white
[oc-sponsors-link]:          https://opencollective.com/phalcon
