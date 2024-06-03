# Setup local env

- Install Docker Desktop https://docs.docker.com/get-docker/
- Install Git and setup access token to repository
- Clone repository in your folder
- Run in console `docker network create meliat-external`
- Run in console `docker-compose up -d`
- Copy .env-example to .env
- Create new DB (and configure in .env)
- Import initial DB from `/database/dump/initial_db`
- Open docker webserver container in terminal, run bash
- Run `/start.sh`
- Run `composer install`
- Run `npm -i`
- Run `php artisan migrate`