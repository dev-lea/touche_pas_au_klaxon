<?php
namespace App\Models;
use App\Core\DB;

final class User {
  public static function findByEmail(string $email): ?array {
    $st = DB::pdo()->prepare('SELECT * FROM users WHERE email=? LIMIT 1');
    $st->execute([$email]); $u = $st->fetch(); return $u ?: null;
  }
  public static function find(int $id): ?array {
    $st = DB::pdo()->prepare('SELECT * FROM users WHERE id=?'); $st->execute([$id]);
    return $st->fetch() ?: null;
  }
}
