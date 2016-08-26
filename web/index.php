<?php

require_once __DIR__ . '/../vendor/autoload.php';

/** @var Silex\Application $app */
$app = require_once dirname(__DIR__) ."/app/bootstrap.php";

$app->mount('/login', new \Controllers\LoginRedirectController())
    ->mount('/account', new \Controllers\RegistrationController())
    ->mount('/admin', new \Controllers\AdminPageController())
    ->mount('/', new \Controllers\WebPageController());


$app->run();
