<?php

namespace Framework;

use Framework\Exception\Handler;
use Framework\Http\Request;
use Symfony\Component\DependencyInjection\Container;
use Throwable;

class Application
{
    private Container $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function start()
    {
        $request = Request::createInstance();
        $exceptionHandler = new Handler();

        try {
            $controller = $this->container->get('front_controller');
            $response = $controller->handle($request);
            $response->send();
        } catch (Throwable $e) {
            $exceptionHandler->handle($e);
        }
    }
}