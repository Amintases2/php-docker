# Docker

Simple php framework

## Stack

- nginx
- php: 8.3-fpm
- mysql: 8
- phpmyadmin

## Deployment

To deploy this project run

```
  cp ./src/.env.example ./src/.env
  docker compose up -d --build
  docker compose exec php composer install
  docker compose exec php php artisan migrate
```

## PMA

- localhost:8080
- root:root

## Authors

- [@Amintases2](https://www.github.com/Amintases2)
