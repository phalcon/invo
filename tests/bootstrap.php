<?php

declare(strict_types=1);

use Dotenv\Dotenv;
use Phalcon\Talon\Settings;
use Phalcon\Talon\Talon;

require_once dirname(__FILE__, 2) . '/vendor/autoload.php';

/**
 * The application compiles Volt templates into var/cache/volt and writes logs to
 * var/logs while it is dispatched in-process; make sure both exist before any test runs.
 */
@mkdir(dirname(__DIR__) . '/var/cache/volt', 0775, true);
@mkdir(dirname(__DIR__) . '/var/logs', 0775, true);

/**
 * Load the test environment into $_ENV. Real OS/CI variables already present win
 * (createImmutable never overwrites them), so the same suite runs in docker
 * (service-name DB host) and native CI (127.0.0.1) unchanged.
 */
Dotenv::createImmutable(__DIR__, '.env.test')->safeLoad();

Talon::boot(Settings::fromEnv());
