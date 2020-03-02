<?php

define('BASE_PATH', __DIR__ . '/..');

require_once __DIR__ .'/../vendor/autoload.php';

try {

    $container = require_once '../bootstrap/container.php';
    $app = new Framework\Application($container);

    $container->set('application', $app);

    $app->start();
} catch (Throwable $e) {
    echo $e->getMessage() . "\n<br>" . $e->getTraceAsString();
}
