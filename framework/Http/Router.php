<?php

namespace Framework\Http;

use Taskholder\Http\CreateTaskAction;
use Taskholder\Http\EditTaskAction;
use Taskholder\Http\IndexAction;
use Taskholder\Http\LoginAction;
use Taskholder\Http\LoginFormAction;

class Router
{
    public static function getRoutes(): array
    {
        return [
            static::get('/', IndexAction::class),
            static::get('/admin/login', LoginFormAction::class),
            static::post('/admin/login', LoginAction::class),
            static::post('/task', CreateTaskAction::class),
            static::put('/task', EditTaskAction::class),
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

    private static function put(string $uri, string $action)
    {
        return [
            'method' => 'PUT',
            'uri' => $uri,
            'action' => $action
        ];
    }
}