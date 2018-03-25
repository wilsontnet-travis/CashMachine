<?php

use Symfony\Component\Dotenv\Dotenv;

putenv('COUNTRY_CODE=test');
putenv('SYMFONY_ENV=test');

(new Dotenv())->load(__DIR__ . '/../.env.test');

require __DIR__ . '/../vendor/autoload.php';
