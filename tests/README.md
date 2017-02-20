GitHubAPI PHPUnit Testing
=========================
The unit tests for GitHubAPI are implemented using the PHPUnit testing framework and require PHPUnit to run.


GitHubAPI PHPUnit Tests on multiple PHP versions using Docker
=============================================================

Run `docker-compose up -d` to create the [PHPFarm](https://github.com/splitbrain/docker-phpfarm) container.

PHP7.0
------
```bash
php-7.0 vendor/bin/phpunit -d memory_limit=512M --colors --debug  --coverage-text
```

PHP7.1
------
```bash
php-7.1 vendor/bin/phpunit -d memory_limit=512M --colors --debug  --coverage-text
```
