<?php

require_once __DIR__ . '/../vendor/autoload.php';

/** @var Silex\Application $app */
$app = require_once dirname(__DIR__) ."/app/bootstrap.php";

$app->mount('/', new \Controllers\WebPageController())
    ->mount('/admin', new \Controllers\AdminPageController())
    ->mount('/account', new \Controllers\RegistrationController());
$app->run();
