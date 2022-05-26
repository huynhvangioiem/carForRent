# carForRent
This is repo for project carForRent
Author: Huynh Van Gioi Em - TLAIT

*common command*
* PHPUnit
- ./vendor/bin/phpunit --testdox tests

* Xdebug
- XDEBUG_MODE=coverage ./vendor/bin/phpunit tests --coverage-html coverage

* PHPCS
- phpcs --standard=PSR12 ./src
- phpcbf --standard=PSR12 ./src

*PSALM
- ./vendor/bin/psalm
- ./vendor/bin/psalm --show-info=true
- ./vendor/bin/psalm  --alter --issues=MissingReturnType,MissingParamType --dry-run
