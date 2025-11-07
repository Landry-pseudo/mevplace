<?php
namespace Config;

use CodeIgniter\Config\BaseConfig;

class Cors extends BaseConfig
{
    public array $default = [
        'allowedOrigins' => ['http://localhost:5173', 'http://127.0.0.1:5173'],
        'allowedMethods' => ['GET', 'POST', 'PUT', 'DELETE', 'OPTIONS', 'PATCH'],
        'allowedHeaders' => ['Content-Type', 'Authorization', 'X-Requested-With', 'Accept'],
        'exposedHeaders' => [],
        'maxAge' => 3600,
        'supportsCredentials' => false,
    ];
}