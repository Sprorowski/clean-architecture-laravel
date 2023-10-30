up:
	./vendor/bin/sail up -d
down:
	./vendor/bin/sail down

ssh:
	docker-compose exec laravel.test sh

optimize:
	docker-compose exec laravel.test php artisan optimize
	docker-compose exec laravel.test php artisan route:clear
	docker-compose exec laravel.test php artisan config:cache
	docker-compose exec laravel.test php artisan  config:clear

refresh:
	docker-compose exec laravel.test php artisan migrate

test:
	docker-compose exec laravel.test php artisan test --coverage --min=75.7

phpcs:
	docker-compose exec laravel.test ./vendor/bin/phpcs --standard=phpcs.xml --colors -ps $(opt)

phpcbf:
	docker-compose exec laravel.test ./vendor/bin/phpcbf --standard=phpcs.xml --extensions=php
