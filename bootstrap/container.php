<?php

$container = new \Symfony\Component\DependencyInjection\ContainerBuilder();
$container->set('container', $container);

$container->register('front_controller', \Framework\Http\FrontController::class)
    ->addArgument($container);

return $container;