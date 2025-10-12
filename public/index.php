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

$router->get('/login', 'AuthController@loginForm');
$router->post('/login', 'AuthController@login');
$router->get('/logout', 'AuthController@logout');

$router->get('/trips/create', 'TripController@createForm');
$router->post('/trips', 'TripController@store');
$router->get('/trips/{id}/edit', 'TripController@editForm');
$router->post('/trips/{id}', 'TripController@update');
$router->post('/trips/{id}/delete', 'TripController@delete');

$router->get('/admin', 'AdminController@dashboard');
$router->post('/admin/agencies', 'AdminController@storeAgency');
$router->post('/admin/agencies/{id}', 'AdminController@updateAgency');
$router->post('/admin/agencies/{id}/delete', 'AdminController@deleteAgency');

$router->run();
