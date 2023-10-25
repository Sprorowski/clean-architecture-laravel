up:
	./vendor/bin/sail up --build
down:
	./vendor/bin/sail down

ssh:
	docker-compose exec laravel.test sh

optimize:
	docker-compose exec laravel.test php artisan optimize

refresh:
	docker-compose exec laravel.test php artisan migrate:fresh --seed

test:
	docker-compose exec laravel.test php artisan test

phpcs:
	docker-compose exec laravel.test ./vendor/bin/phpcs --standard=phpcs.xml --colors -ps $(opt)

phpcbf:
	docker-compose exec laravel.test ./vendor/bin/phpcbf --standard=phpcs.xml --extensions=php
