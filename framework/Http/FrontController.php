<?php

namespace Framework\Http;

use Framework\Container;
use Framework\Exception\HttpNotFoundException;
use Throwable;

class FrontController
{
    private array $routes;

    private Container $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
        $this->routes = Router::getRoutes();
    }

    /**
     * @param Request $request
     * @return Response
     * @throws Throwable
     */
    public function handle(Request $request): Response
    {
        if (!$route = $this->findRoute($request->getMethod(), $request->getUriWithoutParameters())) {
            throw new HttpNotFoundException($request->getUriWithoutParameters());
        }

        $action = $this->container->make($route);

        return $action->execute($request);
    }

    private function findRoute(string $method, string $uri): string
    {
        foreach ($this->routes as $route) {
            if ($route['method'] === $method && $route['uri'] === $uri) {
                return $route['action'];
            }
        }

        return '';
    }
}