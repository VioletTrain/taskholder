<?php

namespace Framework\Http;

use Framework\Exception\HttpNotFoundException;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class FrontController
{
    private array $routes;

    private ContainerBuilder $container;

    public function __construct(ContainerBuilder $container)
    {
        $this->container = $container;
        $this->routes = Router::getRoutes();
    }

    /**
     * @param Request $request
     * @return Response
     * @throws HttpNotFoundException
     */
    public function handle(Request $request): Response
    {
        if (!$route = $this->findRoute($request->getMethod(), $request->getUriWithoutParameters())) {
            throw new HttpNotFoundException($request->getUriWithoutParameters());
        }

        $this->container->register('action', $route);

        $action = $this->container->get('action');

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