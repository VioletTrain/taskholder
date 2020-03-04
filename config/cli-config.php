<?php

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;

require __DIR__ . '/../vendor/autoload.php';

$entityPath = [
    __DIR__ . '/../src/Entity/'
];

$dbParams = [
    'host'     => 'localhost',
    'port'     => '54320',
    'driver'   => 'pdo_pgsql',
    'user'     => 'taskholder_user',
    'password' => 'postgres1234',
    'dbname'   => 'taskholder_db'
];

$connection = \Doctrine\DBAL\DriverManager::getConnection($dbParams);

$doctrineConfig = Setup::createAnnotationMetadataConfiguration($entityPath, true);
$entityManager = EntityManager::create($dbParams, $doctrineConfig);

return new \Symfony\Component\Console\Helper\HelperSet(
    [
        'em' => new \Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper($entityManager),
        'db' => new \Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper($connection),
    ]
);