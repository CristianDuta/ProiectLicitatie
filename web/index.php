<?php

require_once __DIR__ . '/../vendor/autoload.php';

$app = require_once dirname(__DIR__) ."/app/bootstrap.php";

$app->mount('/', new \Controllers\PageController());
$app->run();
