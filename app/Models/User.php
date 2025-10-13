<?php
namespace App\Models;
use App\Core\DB;

final class User {
  public static function findByEmail(string $email): ?array {
    $st = DB::pdo()->prepare('SELECT * FROM users WHERE email = ? LIMIT 1');
    $st->execute([$email]);
    return $st->fetch() ?: null;
  }
  public static function all(): array {
    return DB::pdo()->query('SELECT * FROM users ORDER BY last_name, first_name')->fetchAll();
  }
}
