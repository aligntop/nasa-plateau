Running this project
===

### Tools
- Docker for Mac
- Docker Compose

### Install
```
git clone https://github.com/aligntop/werkspot.git
cd werkspot
docker-compose up --build -d
docker-compose exec php-fpm composer install
```
### Run PHP Unit
```
docker-compose exec php-fpm ./vendor/bin/phpunit -c src/phpunit.xml
```

* **Hint:** You can run test with coverage and see the results in HTML with the following command (all output html will be stored in a new folder called coverage).
```
docker-compose exec php-fpm ./vendor/bin/phpunit -c src/phpunit.xml --coverage-html coverage
```

### Thanks
I wanted to really thank you for this opportunity, I did my best to deliver something easily executable and testable ( I made everything from scratch today! ).  