install:
	- composer install
	- cp ./.env.example ./.env
	- ./vendor/bin/sail up -d

start:
	- ./vendor/bin/sail up -d
	- ./vendor/bin/sail npm run dev

setup:
	- ./vendor/bin/sail artisan key:generate
	- ./vendor/bin/sail artisan migrate:fresh --seed
	- ./vendor/bin/sail npm install

