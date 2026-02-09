SHELL := /bin/bash

.PHONY: up down reset sh logs install migrate test artisan

clear:
	docker compose run --rm app php artisan route:clear
	docker compose run --rm app php artisan config:clear
	docker compose run --rm app php artisan cache:clear
	docker compose run --rm app php artisan view:clear

up:
	docker compose up -d --build

down:
	docker compose down

build:
	docker compose build app

reset:
	rm -rf vendor node_modules bootstrap/cache/*.php public/storage
	rm -f .env

sh:
	docker compose exec -u www-data app bash

logs:
	docker compose logs -f --tail=100

install:
	# Crea Laravel solo si no existe (no pisa nada)
	if [ ! -f artisan ]; then \
		docker compose run --rm app bash -lc 'set -e; \
		  composer create-project laravel/laravel /tmp/laravel; \
		  shopt -s dotglob; \
		  cp -an /tmp/laravel/* /var/www/html/'; \
	fi
	cp -n .env.example .env || true
	docker compose run --rm app php artisan key:generate
	docker compose run --rm app php artisan storage:link

migrate:
	docker compose run --rm app php artisan migrate

test:
	docker compose run --rm app php artisan test -q

artisan:
	@docker compose run --rm app php artisan $(CMD)
	@true

composer:
	@docker compose run --rm app composer $(CMD)
	@true

reverb:
	docker compose exec app php artisan reverb:start --port=8081

queue:
	docker compose exec app php artisan queue:work