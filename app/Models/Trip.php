<?php
namespace App\Models;

use App\Core\DB;
use PDO;

final class Trip
{
    /**
     * Page d’accueil : trajets à venir avec places dispo,
     * enrichis avec noms d’agences + infos auteur.
     */
    public static function listPublic(): array
    {
        $sql = "
            SELECT
                t.*,
                fa.name AS from_name,
                ta.name AS to_name,
                u.first_name, u.last_name, u.email, u.phone
            FROM trips t
            INNER JOIN agencies fa ON fa.id = t.from_agency_id
            INNER JOIN agencies ta ON ta.id = t.to_agency_id
            INNER JOIN users    u  ON u.id  = t.author_id
            WHERE t.depart_at >= NOW()
              AND t.seats_available > 0
            ORDER BY t.depart_at ASC
        ";
        return DB::pdo()->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Admin : tous les trajets (passés inclus),
     * enrichis avec les mêmes colonnes que listPublic().
     */
    public static function listAll(): array
    {
        $sql = "
            SELECT
                t.*,
                fa.name AS from_name,
                ta.name AS to_name,
                u.first_name, u.last_name, u.email, u.phone
            FROM trips t
            INNER JOIN agencies fa ON fa.id = t.from_agency_id
            INNER JOIN agencies ta ON ta.id = t.to_agency_id
            INNER JOIN users    u  ON u.id  = t.author_id
            ORDER BY t.depart_at DESC
        ";
        return DB::pdo()->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    /** Récupérer un trajet par id (avec enrichissements) */
    public static function find(int $id): ?array
    {
        $sql = "
            SELECT
                t.*,
                fa.name AS from_name,
                ta.name AS to_name,
                u.first_name, u.last_name, u.email, u.phone
            FROM trips t
            INNER JOIN agencies fa ON fa.id = t.from_agency_id
            INNER JOIN agencies ta ON ta.id = t.to_agency_id
            INNER JOIN users    u  ON u.id  = t.author_id
            WHERE t.id = :id
            LIMIT 1
        ";
        $stmt = DB::pdo()->prepare($sql);
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ?: null;
    }

    /** Création */
    public static function create(array $data): int
    {
        $sql = "
            INSERT INTO trips
            (from_agency_id, to_agency_id, depart_at, arrive_at, seats_total, seats_available, author_id)
            VALUES (:from_agency_id, :to_agency_id, :depart_at, :arrive_at, :seats_total, :seats_available, :author_id)
        ";
        $stmt = DB::pdo()->prepare($sql);
        $stmt->execute([
            ':from_agency_id'  => $data['from_agency_id'],
            ':to_agency_id'    => $data['to_agency_id'],
            ':depart_at'       => $data['depart_at'],
            ':arrive_at'       => $data['arrive_at'],
            ':seats_total'     => $data['seats_total'],
            ':seats_available' => $data['seats_available'],
            ':author_id'       => $data['author_id'],
        ]);
        return (int)DB::pdo()->lastInsertId();
    }

    /** Mise à jour */
    public static function update(int $id, array $data): void
    {
        $sql = "
            UPDATE trips
            SET from_agency_id=:from_agency_id,
                to_agency_id=:to_agency_id,
                depart_at=:depart_at,
                arrive_at=:arrive_at,
                seats_total=:seats_total,
                seats_available=:seats_available
            WHERE id=:id
        ";
        $stmt = DB::pdo()->prepare($sql);
        $stmt->execute([
            ':from_agency_id'  => $data['from_agency_id'],
            ':to_agency_id'    => $data['to_agency_id'],
            ':depart_at'       => $data['depart_at'],
            ':arrive_at'       => $data['arrive_at'],
            ':seats_total'     => $data['seats_total'],
            ':seats_available' => $data['seats_available'],
            ':id'              => $id,
        ]);
    }

    /** Suppression */
    public static function delete(int $id): void
    {
        $stmt = DB::pdo()->prepare("DELETE FROM trips WHERE id=:id");
        $stmt->execute([':id' => $id]);
    }
}
