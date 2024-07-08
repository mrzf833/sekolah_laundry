# LARAVEL 8
## Di buat memakai php 8.0

# Cara Pemasangan

- `composer install`
- `cp .env.example .env`
- `BUKAK .env LALU SETTING DATABASENYA`
- `php artisan key:generate`
- `composer dump-auto`
- `php artisan migrate:fresh --seed`
- `php artisan storage:link`

# user default
## admin
- `username : admin`
- `password : admin`

# dengan docker
## install
- `docker compose up -d --build`
- `docker exec -it laundry_app /bin/sh`
- `php artisan migrate:fresh --seed`

## uninstall
- `docker compose down --rmi=all`
