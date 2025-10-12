<?php
namespace App\Models;
use App\Core\DB;

final class Agency {
  public static function all(): array {
    return DB::pdo()->query('SELECT * FROM agencies ORDER BY name')->fetchAll();
  }
  public static function create(string $name): void {
    $s=DB::pdo()->prepare('INSERT INTO agencies(name) VALUES(?)'); $s->execute([$name]);
  }
  public static function update(int $id,string $name): void {
    $s=DB::pdo()->prepare('UPDATE agencies SET name=? WHERE id=?'); $s->execute([$name,$id]);
  }
  public static function delete(int $id): void {
    $s=DB::pdo()->prepare('DELETE FROM agencies WHERE id=?'); $s->execute([$id]);
  }
}
