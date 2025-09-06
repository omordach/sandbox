UID ?= $(shell id -u)
GID ?= $(shell id -g)

.PHONY: up down restart logs sh php npm migrate seed test e2e

up:
	docker compose up -d --build

down:
	docker compose down

restart:
	docker compose restart

logs:
	docker compose logs -f

sh:
	docker compose exec app sh

php:
	docker compose exec app php $(ARGS)

npm:
	docker compose exec vite npm $(ARGS)

migrate:
	docker compose exec app php artisan migrate

seed:
	docker compose exec app php artisan db:seed

test:
	docker compose exec app composer test

e2e:
	docker compose exec vite npm run test:e2e
