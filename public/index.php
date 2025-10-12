<?php
declare(strict_types=1);
use Buki\Router\Router;

require __DIR__.'/../vendor/autoload.php';
session_start();
Dotenv\Dotenv::createImmutable(dirname(__DIR__))->load();

$router = new Router([
  'base_folder' => dirname(__DIR__).'/app/Controllers',
  'paths' => ['controllers' => 'App\Controllers'],
]);

$router->get('/', 'HomeController@index');

$router->run();
