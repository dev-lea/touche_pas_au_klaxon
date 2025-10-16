<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use App\Core\DB;
use App\Models\Trip;

final class TripTest extends TestCase
{
    public static function setUpBeforeClass(): void
    {
        DB::pdo()->beginTransaction();
    }

    public static function tearDownAfterClass(): void
    {
        DB::pdo()->rollBack();
    }

    public function testCreateUpdateDeleteTrip(): void
    {
        // suppose: agencies (1,2) + author_id=1 existent (seed)
        $data = [
            'from_agency_id'   => 1,
            'to_agency_id'     => 2,
            'depart_at'        => date('Y-m-d H:i:s', time() + 3600),
            'arrive_at'        => date('Y-m-d H:i:s', time() + 7200),
            'seats_total'      => 3,
            'seats_available'  => 2,
            'author_id'        => 1,
        ];

        $id = Trip::create($data);
        $this->assertIsInt($id);

        $row = Trip::find($id);
        $this->assertNotNull($row);
        $this->assertSame(3, (int)$row['seats_total']);

        Trip::update($id, [
            'from_agency_id'   => 1,
            'to_agency_id'     => 2,
            'depart_at'        => $data['depart_at'],
            'arrive_at'        => $data['arrive_at'],
            'seats_total'      => 4,
            'seats_available'  => 3,
        ]);

        $row2 = Trip::find($id);
        $this->assertSame(4, (int)$row2['seats_total']);
        $this->assertSame(3, (int)$row2['seats_available']);

        Trip::delete($id);
        $this->assertNull(Trip::find($id));
    }
}
