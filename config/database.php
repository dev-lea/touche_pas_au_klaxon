<?php
return [
  'dsn' => sprintf(
    'mysql:host=%s;port=%s;dbname=%s;charset=utf8mb4',
    $_ENV['DB_HOST'], $_ENV['DB_PORT'], $_ENV['DB_DATABASE']
  ),
  'user' => $_ENV['DB_USERNAME'],
  'pass' => $_ENV['DB_PASSWORD'],
];
