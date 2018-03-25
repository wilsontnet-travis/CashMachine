Cash Machine
========================

Develop a solution that simulate the delivery of notes when a client does a withdraw in a cash machine.

For example

Let's say the cashmachine has notes type [50, 20 ,10]

* When the input is `120`, the expected output will be `[50, 50 10]`
* When the input is `80`, the expected output will be `[50, 20 ,10]`
* When the input is `-120`, it will throw `InvalidArgumentException`
* When the input is `55`, it will throw `NoteUnavailableException`


Project Spec/Requirement
--------------
* PHP 7.1.13
* Symfony 3.4
* PHPUNIT 4.8
* PHP-CS-FIXER 2.2

Project Installation / Setup
--------------
Steps

1. Install compsoer on your system
2. Run `composer install`(prod)  or `--dev --ignore-platform-reqs`(dev) on project root
3. Copy parameters.yml  `cp app/config/parameters.yml.dist app/config/parameters.yml` 
4. Config available notes option in `app/config/parameters.yml`


For examples
```
available_notes:
      - 10
      - 20
      - 50
```

Dev Notes
--------------
* Please run `bin/console server:start` to start local webserver
* For test api run below CURL after starting local webserver
```curl -X GET \
  http://127.0.0.1:8000/api/v1/cash/120 \
  -H 'cache-control: no-cache'
```
* For php-cs-fixer please run
```
./vendor/friendsofphp/php-cs-fixer/php-cs-fixer fix -vvv --using-cache=no --allow-risky=yes --config=.php_cs --path-mode=intersection {file_path}
```

For Unit Test with phpunit
--------------
* Please run unit test by `bin/phpunit  -debug -vvv --testsuite api`
* You can find the default phpunit config at `./phpunit.xml.dist`
* You can find the symfony config file for test at `app/config/config_test.yml`
