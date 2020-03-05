<?php

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Setup;
use Framework\Container;
use Framework\Contract\EntityManager as CustomEntityManagerInterface;
use Framework\EntityManager as CustomEntityManager;

$container = new Container();

$container->singleton(Container::class, Container::class);
$container->singleton(EntityManagerInterface::class, function () {
    $config = include(BASE_PATH . '/config/db.php');
    $doctrineConfig = Setup::createAnnotationMetadataConfiguration($config['entity_paths'], $config['dev_mode']);

    return EntityManager::create($config['db_params'], $doctrineConfig);
});
$container->singleton(CustomEntityManagerInterface::class, CustomEntityManager::class);

return $container;