GitHubAPI PHPUnit Testing
=========================
The unit tests for GitHubAPI are implemented using the PHPUnit testing framework and require PHPUnit to run.

GitHubAPI PHPUnit Tests on multiple PHP versions using Docker
=============================================================
1. Run `docker-compose up -d` to create the [PHPFarm](https://github.com/splitbrain/docker-phpfarm) container.
2. Replace credentials (*USERNAME*, *PASSWORD*, *ORGANIZATION*) in `phpunit.xml.dist` file.

> ⚠ Be careful, executing this tests will create Organization, Issue, PullRequest, Gists, Repositories ⚠

PHP7.1
------
```bash
php-7.1 vendor/bin/phpunit -d memory_limit=512M --colors --debug  --coverage-text
```

PHP7.2
------
```bash
php-7.2 vendor/bin/phpunit -d memory_limit=512M --colors --debug  --coverage-text
```
