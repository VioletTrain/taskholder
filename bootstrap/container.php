<?php

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Setup;
use Framework\Container;
use Framework\Contract\EntityManager as CustomEntityManagerInterface;
use Framework\EntityManager as CustomEntityManager;
use Twig\Environment;
use Twig\Extension\DebugExtension;
use Twig\Loader\FilesystemLoader;

$container = new Container();

$container->singleton(Container::class, Container::class);
$container->singleton(CustomEntityManagerInterface::class, CustomEntityManager::class);

$container->singleton(EntityManagerInterface::class, function () {
    $config = include(BASE_PATH . '/config/db.php');
    $doctrineConfig = Setup::createAnnotationMetadataConfiguration($config['entity_paths'], $config['dev_mode']);

    return EntityManager::create($config['db_params'], $doctrineConfig);
});

$container->bind(Environment::class, function () {
    $loader = new FilesystemLoader(BASE_PATH . '/template');
    $twig = new Environment($loader, ['debug' => true]);
    $twig->addExtension(new DebugExtension());

    return $twig;
});

return $container;