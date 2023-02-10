up:
	cd docker && docker-compose -f docker-compose.yml up -d
down:
	cd docker && docker-compose down --remove-orphans
install:
	cd docker && docker-compose build && cd .. && make up && make composer-install
composer-install:
	make up && cd docker && docker exec -it docker_base-php_1 composer install