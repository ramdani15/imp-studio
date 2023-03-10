## IMP Studio  API

IMP Studio API.


## Features

- Login / Logout
- Signup
- List Users
- Swagger API Documentation (`/api/documentation`)


## Installation Guide

- Clone repo with `git clone https://github.com/ramdani15/imp-studio-api.git`
- Run `composer install`
- Copy `env.example` to `.env` and set it with your own credentials
- For testing copy `env.example` to `.env.testing` and set it with your own credentials
- Run `php artisan migrate:refresh --seed`
- Run `php artisan key:generate`
- Run testing `php artisan test`
- Run `php artisan serve`
- Open [http://localhost:8000](http://localhost:8000)
- Open [http://localhost:8000/api/documentation](http://localhost:8000/api/documentation) for API Documentation


## Installation Guide (Docker Compose)

- Clone repo with `git clone https://github.com/ramdani15/imp-studio-api.git`
- Copy `env.example` to `.env` and set it with your own credentials
- For testing copy `env.example` to `.env.testing` and set it with your own credentials
- On `.env` and `.env.testing` set `DB_HOST=db-imp` and `DB_PORT=3306`
- Copy `/docker/env.example` to `/docker/.env` and set it with your own credentials
- Run `docker compose up -d --build`
- Run `docker compose exec app composer install`
- Run `docker compose exec app php artisan migrate:refresh --seed`
- Run `docker compose exec app php artisan key:generate`
- Run testing `docker compose exec app php artisan test`
- Open [http://localhost:3000](http://localhost:3000)
- Open [http://localhost:3000/api/documentation](http://localhost:3000/api/documentation) for API Documentation


### Notes
- User testing `super` with password `password123`
- Code style fixer with [Laravel Pint](https://github.com/laravel/pint) RUN : `sh pint.sh` or `docker compose exec app sh pint.sh` for Docker.
