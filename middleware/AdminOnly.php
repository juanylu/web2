<?php
// middlewares/AdminOnly.php

namespace Middleware;

class AdminOnly
{
    public function handle()
    {
        session_start();

        if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['tipo'] !== 'admin') {
            http_response_code(403);
            require __DIR__ . '/../pages/inicio.php';
            exit;
        }
    }
}
