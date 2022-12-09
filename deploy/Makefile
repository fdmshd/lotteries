env:
	if ! test -f ".env"; then cp .env.example .env; fi

migrate:
	docker-compose exec lotteries_api php artisan migrate

key:
	php -r "echo md5(uniqid()).\"\n\";"

up:
	cp .env ../project/.env
	docker-compose up -d --build
	docker-compose exec lotteries_api composer install

dbseed:
	docker-compose exec lotteries_api php artisan db:seed

down:
	docker-compose down