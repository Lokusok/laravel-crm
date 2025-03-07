up:
	- docker compose up -d --build

setup:
	- ./vendor/bin/sail artisan key:generate
	- ./vendor/bin/sail artisan migrate:fresh --seed
	- ./vendor/bin/sail npm install

start:
	- ./vendor/bin/sail up
	- ./vendor/bin/sail npm run dev
