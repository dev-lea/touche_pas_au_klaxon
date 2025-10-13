<?php
declare(strict_types=1);

ini_set('display_errors','1');
ini_set('display_startup_errors','1');
error_reporting(E_ALL & ~E_DEPRECATED & ~E_USER_DEPRECATED);

require __DIR__ . '/../vendor/autoload.php';
session_start();

// Charge .env
Dotenv\Dotenv::createImmutable(dirname(__DIR__))->load();

// -------------------------------------------------------
// Router
// -------------------------------------------------------
$router = new \Buki\Router\Router([
  'base_folder' => dirname(__DIR__) . '/app/Controllers',
  'paths'       => ['controllers' => 'App\\Controllers'],
]);

// Tous les {id} (trips, etc.) doivent être numériques
$router->pattern('id', '[0-9]+');

// ===================== HOME =====================
$router->get('/', function () {
  $c = new \App\Controllers\HomeController();
  return $c->index();
});

// ===================== AUTH =====================
$router->get('/login', function () {
  $c = new \App\Controllers\AuthController();
  return $c->loginForm();
});
$router->post('/login', function () {
  $c = new \App\Controllers\AuthController();
  return $c->login();
});
$router->get('/logout', function () {
  $c = new \App\Controllers\AuthController();
  return $c->logout();
});

// ===================== TRIPS (USER) =====================
$router->get('/trips/create', function () {
  $c = new \App\Controllers\TripController();
  return $c->createForm();
});
$router->post('/trips', function () {
  $c = new \App\Controllers\TripController();
  return $c->store();
});
$router->get('/trips/{id}/edit', function ($id) {
  $c = new \App\Controllers\TripController();
  return $c->editForm((int)$id);
});
$router->post('/trips/{id}', function ($id) {
  $c = new \App\Controllers\TripController();
  return $c->update((int)$id);
});
$router->post('/trips/{id}/delete', function ($id) {
  $c = new \App\Controllers\TripController();
  return $c->delete((int)$id);
});

// ===================== ADMIN =====================
$router->get('/admin', function () {
  $c = new \App\Controllers\AdminController();
  return $c->dashboard();
});
$router->get('/admin/users', function () {
  $c = new \App\Controllers\AdminController();
  return $c->users();
});
$router->get('/admin/agencies', function () {
  $c = new \App\Controllers\AdminController();
  return $c->agencies();
});
$router->get('/admin/trips', function () {
  $c = new \App\Controllers\AdminController();
  return $c->trips();
});

// ===================== ADMIN / AGENCIES (UNIQUE POST) =====================
// Page liste
$router->get('/admin/agencies', function () {
  $c = new \App\Controllers\AdminController();
  return $c->agencies();
});

// POST multi-actions: create / update / delete
$router->post('/admin/agencies', function () {
  $c = new \App\Controllers\AdminController();
  return $c->agenciesPost(); // <-- nouvelle méthode
});

// ===================== DIAG / DB =====================
$router->get('/db-check', function () {
  try {
    $cfg = require __DIR__ . '/../config/database.php';
    $pdo = new PDO($cfg['dsn'], $cfg['user'], $cfg['pass'], [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
    $row = $pdo->query("SELECT COUNT(*) AS c FROM agencies")->fetch();
    return new \Symfony\Component\HttpFoundation\Response(
      "DB OK, agencies=".$row['c'], 200, ['Content-Type'=>'text/plain']
    );
  } catch (Throwable $e) {
    return new \Symfony\Component\HttpFoundation\Response(
      "DB ERROR: ".$e->getMessage(), 500, ['Content-Type'=>'text/plain']
    );
  }
});

// Ping diag
$router->get('/diag/ping', fn() => new \Symfony\Component\HttpFoundation\Response('pong',200));

// DIAG POST: pour vérifier ce que reçoit le router (à enlever après debug)
$router->post('/diag/echo', function () {
  return new \Symfony\Component\HttpFoundation\Response(
    json_encode([
      'method' => $_SERVER['REQUEST_METHOD'] ?? null,
      'uri'    => $_SERVER['REQUEST_URI'] ?? null,
      'post'   => $_POST,
    ], JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE),
    200, ['Content-Type'=>'application/json']
  );
});

// -------------------------------------------------
$router->run();
