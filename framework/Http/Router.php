<?php

namespace Framework\Http;

use Taskholder\Http\CreateTaskAction;
use Taskholder\Http\GetTasksAction;

class Router
{
    public static function getRoutes(): array
    {
        return [
            static::post('/task', CreateTaskAction::class),
            static::get('/tasks', GetTasksAction::class),
        ];
    }

    private static function get(string $uri, string $action)
    {
        return [
            'method' => 'GET',
            'uri' => $uri,
            'action' => $action
        ];
    }

    private static function post(string $uri, string $action)
    {
        return [
            'method' => 'POST',
            'uri' => $uri,
            'action' => $action
        ];
    }
}