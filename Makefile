setup:
	composer install
	php artisan key:generate
	npm install
	npm run build
	php artisan migrate
	php artisan storage:link

dev:
	php artisan serve

migrate:
	php artisan migrate

migrate-fresh:
	php artisan migrate:fresh

rollback:
	php artisan migrate:rollback