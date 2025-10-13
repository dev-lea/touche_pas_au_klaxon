<?php
namespace App\Models;
use App\Core\DB;

final class Agency {
  public static function all(): array {
    return DB::pdo()->query('SELECT * FROM agencies ORDER BY name')->fetchAll();
  }
  public static function create(string $name): void {
    DB::pdo()->prepare('INSERT INTO agencies(name) VALUES(?)')->execute([$name]);
  }
  public static function update(int $id, string $name): void {
    DB::pdo()->prepare('UPDATE agencies SET name=? WHERE id=?')->execute([$name,$id]);
  }
  public static function delete(int $id): void {
    DB::pdo()->prepare('DELETE FROM agencies WHERE id=?')->execute([$id]);
  }
}
