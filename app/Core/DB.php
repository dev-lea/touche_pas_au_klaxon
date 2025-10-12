<?php
namespace App\Core;
use PDO;

final class DB {
  private static ?PDO $pdo = null;
  public static function pdo(): PDO {
    if (self::$pdo) return self::$pdo;
    $cfg = require __DIR__.'/../../config/database.php';
    self::$pdo = new PDO($cfg['dsn'],$cfg['user'],$cfg['pass'],[
      PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC,
    ]);
    return self::$pdo;
  }
}
