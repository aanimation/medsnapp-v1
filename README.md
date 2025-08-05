## MedSnapp Project

### Clone Repo
`git clone git@github.com:aanimation/medsnapp-v1.git`

### Setup
- Install and run Docker
- Install composer
- Run `composer install`

### Prepare
- Copy `.env.example` to `.env` and fill the database credentials
- Run `php artisan key:generate`

### Run
- Run `./vendor/bin/sail up` and wait until it's ready, (MYSQL, Redis, Mailpit, Meilisearch, Selenium) look docker-compose.yml for more details
- Run `php artisan migrate`
- Run `php artisan serve` (DONT RUN THIS, IT WILL NOT WORK AUTOMATICALLY)
- Open `http://localhost` on your browser

### Seed
- Run `php artisan db:seed` (optional)

#### Storage Permission
`sudo chmod -R 777 storage`

#### NOTES
[mailpit](http://localhost:8025/) reserved for local mailing by sail
[staging](https://staging.medsnapp.com/)
