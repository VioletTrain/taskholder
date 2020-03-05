<?php

namespace Framework;

use Framework\Exception\Handler;
use Framework\Http\FrontController;
use Framework\Http\Request;
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
        session_start();
        $request = Request::createInstance();
        $exceptionHandler = new Handler();

        try {
            $controller = $this->container->make(FrontController::class);
            $response = $controller->handle($request);
            $response->send();
        } catch (Throwable $e) {
            $exceptionHandler->handle($e);
        }
    }
}