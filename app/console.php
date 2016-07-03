#!/usr/bin/env php
<?php

set_time_limit(0);

require_once __DIR__ . '/../vendor/autoload.php';

$app = require_once dirname(__DIR__) ."/app/bootstrap.php";

/** @var \Knp\Console\Application $console */
$console = &$app["console"];
$console->add(new \BusinessLogic\MailQueueProcess());
$console->add(new \BusinessLogic\EnqueueMailProcess());
$console->run();
