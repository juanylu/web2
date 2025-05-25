<?php
// middlewares/Middleware.php

namespace Middleware;

class Middleware
{
    public const MAP = [
        'admin' => AdminOnly::class
    ];

    public static function resolve($key)
    {
        if (!$key) return;

        $middleware = self::MAP[$key] ?? null;

        if (!$middleware) {
            throw new \Exception("No se encontro clave '{$key}'");
        }

        (new $middleware)->handle();
    }
}
