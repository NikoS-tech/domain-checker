# Domain Checker

Admin panel for automatic domain availability monitoring. Laravel 12, Blade, Reverb, MySQL 8.

## Structure

```
.
├── docker/              docker images and configs
│   ├── nginx/
│   └── php/
├── docker-compose.yml   orchestration
└── src/                 Laravel application
```

## Cold start

```
docker compose build
docker compose up -d mysql
docker compose run --rm app composer install --no-interaction --prefer-dist --optimize-autoloader
docker compose run --rm app cp .env.example .env
docker compose run --rm app php artisan key:generate --force
docker compose run --rm app php artisan migrate --force
docker compose up -d
```

- App: http://localhost:8000
- Reverb (websockets): localhost:8080
- MySQL: localhost:3307

## Features

- Registration, login, logout, protected pages
- Add / edit / delete domains and a per-user domain list
- Per-domain checks, each with its own interval, timeout and method (GET / HEAD); create / edit / delete and manual run
- Scheduled automatic checks; every check runs on its own interval and each result is stored in history
- Reverb notification on every new log entry
- Check logs per domain with pagination (date, result, status code, response time, error)

## Services

| Service   | Role                                  |
|-----------|---------------------------------------|
| mysql     | database                              |
| app       | php-fpm (PHP application)              |
| nginx     | web server                            |
| reverb    | websocket server                      |
| scheduler | runs the check schedule every minute  |
```
