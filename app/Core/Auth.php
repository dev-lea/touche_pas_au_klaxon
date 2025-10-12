<?php
namespace App\Core;
final class Auth {
  public static function user(): ?array { return $_SESSION['user'] ?? null; }
  public static function id(): ?int { return self::user()['id'] ?? null; }
  public static function check(): bool { return (bool) self::user(); }
  public static function isAdmin(): bool { return self::user()['role'] === 'admin'; }
}
