#!/usr/bin/env bash
set -euo pipefail

# Wait until the database accepts connections
bash bin/wait-for-db

# Ensure writable runtime cache/log directories exist
mkdir -p \
    var/cache/volt \
    var/logs

# Apply schema and import seed data (idempotent; ignore "already applied")
vendor/bin/phalcon-migrations run --config=resources/migrations.php || true

# Hand off to the container command (the web server)
exec "$@"
