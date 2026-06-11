#!/bin/bash

# Generate application key if not set
if [ -z "$APP_KEY" ]; then
    php artisan key:generate --force
fi

# Run database migrations
php artisan migrate --force

# Clear and cache config
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Start Laravel server with dynamic port from $PORT env var
exec php artisan serve --host=0.0.0.0 --port=${PORT:-10000}

