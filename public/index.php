<?php

define('BASE_PATH', __DIR__ . '/..');

require_once __DIR__ .'/../vendor/autoload.php';

try {
    $container = require_once '../bootstrap/container.php';
    $app = new Framework\Application($container);

    $app->start();
} catch (Throwable $e) {
    echo $e->getMessage() . "\n" . $e->getTraceAsString() . "\n";
}
