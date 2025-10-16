<?php
declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';
date_default_timezone_set('Europe/Paris');

$envPath = dirname(__DIR__);
if (file_exists($envPath.'/.env.test')) {
    Dotenv\Dotenv::createImmutable($envPath, '.env.test')->load();
} else {
    Dotenv\Dotenv::createImmutable($envPath)->load();
}
