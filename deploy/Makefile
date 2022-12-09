env:
	if ! test -f ".env"; then cp .env.example .env; fi

key:
	php -r "echo md5(uniqid()).\"\n\";"

up:
	cp .env ../project/.env
	docker-compose up -d --build
	docker-compose exec lotteries_api composer install

down:
	docker-compose down