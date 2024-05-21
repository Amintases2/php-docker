# Docker
Simple php framework

## Stack
- nginx
- php: 8.3-fpm
- mysql: 8
- phpmyadmin
- Elastic + kibana + logstash

## Deployment
To deploy this project run

```
  create .env from .env.example
  docker-compose up -d --build
  docker compose exec php composer install
  docker compose exec db sed -i -e 's/\r$//' docker-entrypoint-initdb.d/entrypoint.sh
  docker compose exec db sh docker-entrypoint-initdb.d/entrypoint.sh
```

## PMA
- localhost:8080
- root:root

## Kibana
- localhost:5601

## Authors

- [@Amintases2](https://www.github.com/Amintases2)