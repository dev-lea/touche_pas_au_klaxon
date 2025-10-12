<?php
namespace App\Models;
use App\Core\DB;

final class Trip {
  public static function listPublic(): array {
    $sql = "SELECT t.*, a1.name AS from_name, a2.name AS to_name, u.first_name, u.last_name, u.email, u.phone
            FROM trips t
            JOIN agencies a1 ON a1.id=t.from_agency_id
            JOIN agencies a2 ON a2.id=t.to_agency_id
            JOIN users u ON u.id=t.author_id
            WHERE t.seats_available > 0 AND t.depart_at > NOW()
            ORDER BY t.depart_at ASC";
    return DB::pdo()->query($sql)->fetchAll();
  }
  public static function listAll(): array {
    return DB::pdo()->query("SELECT * FROM trips")->fetchAll();
  }
  public static function find(int $id): ?array {
    $s = DB::pdo()->prepare("SELECT * FROM trips WHERE id=?"); $s->execute([$id]);
    return $s->fetch() ?: null;
  }
  public static function create(array $d): int {
    $sql="INSERT INTO trips(from_agency_id,to_agency_id,depart_at,arrive_at,seats_total,seats_available,author_id)
          VALUES(:from,:to,:dep,:arr,:tot,:avail,:author)";
    DB::pdo()->prepare($sql)->execute($d);
    return (int)DB::pdo()->lastInsertId();
  }
  public static function update(int $id,array $d): void {
    $d['id']=$id;
    $sql="UPDATE trips SET from_agency_id=:from,to_agency_id=:to,depart_at=:dep,arrive_at=:arr,
         seats_total=:tot,seats_available=:avail WHERE id=:id AND author_id=:author";
    DB::pdo()->prepare($sql)->execute($d);
  }
  public static function delete(int $id,int $authorId,bool $force=false): void {
    $sql = $force ? "DELETE FROM trips WHERE id=?" : "DELETE FROM trips WHERE id=? AND author_id=?";
    $st = DB::pdo()->prepare($sql);
    $force ? $st->execute([$id]) : $st->execute([$id,$authorId]);
  }
}
