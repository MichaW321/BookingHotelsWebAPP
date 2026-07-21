<?php

use PHPUnit\Framework\TestCase;

class ReservationDatabaseTest extends TestCase
{
    private $pdo;

    private $countryId;
    private $cityId;
    private $locationId;
    private $hotelId;
    private $roomId;
    private $userId;
    private $reservationId;

    protected function setUp(): void
    {
        $host = 'db';
        $db   = 'bookify';
        $user = 'root';
        $pass = '';

        // Konekcija na tvoju bazu
        $this->pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);

        // 1. Ubacujemo dummy podate u povezane tabele (zbog FOREIGN KEY restrikcija)
        $this->pdo->exec("INSERT INTO country (name) VALUES ('Test Country')");
        $this->countryId = $this->pdo->lastInsertId();

        $this->pdo->exec("INSERT INTO city (name, country_id) VALUES ('Test City', {$this->countryId})");
        $this->cityId = $this->pdo->lastInsertId();

        $this->pdo->exec("INSERT INTO location (city_id, address) VALUES ({$this->cityId}, 'Test Adresa 123')");
        $this->locationId = $this->pdo->lastInsertId();

        $this->pdo->exec("INSERT INTO hotel (name, location_id, description, type, email, phone) 
                          VALUES ('Test Hotel', {$this->locationId}, 'Opis', 'Hotel', 'hotel@test.com', '123456')");
        $this->hotelId = $this->pdo->lastInsertId();

        $this->pdo->exec("INSERT INTO room (beds, balcony, pricePerNight, type, description, hotel_id) 
                          VALUES (2, 1, 50.00, 'Deluxe', 'Soba opis', {$this->hotelId})");
        $this->roomId = $this->pdo->lastInsertId();

        // Jedinstveni email za test korisnika
        $testEmail = 'tester_' . time() . '@example.com';
        $this->pdo->exec("INSERT INTO users (username, first_name, last_name, email, password, role) 
                          VALUES ('tester', 'Petar', 'Petrović', '$testEmail', 'hash123', 'user')");
        $this->userId = $this->pdo->lastInsertId();
    }

    // PRAVI TEST: Upis rezervacije u tabelu `reservation`
    public function testCanInsertReservationIntoDatabase()
    {
        $checkIn    = '2026-09-01';
        $checkOut   = '2026-09-05';
        $totalPrice = 200.00;

        // Upit prema TVOJOJ strukturi tabele `reservation`
        $stmt = $this->pdo->prepare("
            INSERT INTO reservation (user_id, room_id, check_in, check_out, total_price) 
            VALUES (:user_id, :room_id, :check_in, :check_out, :total_price)
        ");

        $executed = $stmt->execute([
            ':user_id'     => $this->userId,
            ':room_id'     => $this->roomId,
            ':check_in'    => $checkIn,
            ':check_out'   => $checkOut,
            ':total_price' => $totalPrice
        ]);

        $this->reservationId = $this->pdo->lastInsertId();

        // --- PROVERE ---
        
        // A) Proveravamo da li je INSERT prošao
        $this->assertTrue($executed, "INSERT u tabelu reservation nije uspeo.");
        $this->assertGreaterThan(0, $this->reservationId, "Baza nije generisala ID za rezervaciju.");

        // B) Dohvatamo upisanu rezervaciju iz baze preko SELECT-a
        $selectStmt = $this->pdo->prepare("SELECT * FROM reservation WHERE id = :id");
        $selectStmt->execute([':id' => $this->reservationId]);
        $reservation = $selectStmt->fetch();

        // C) Proveravamo tačnost upisanih vrednosti
        $this->assertNotEmpty($reservation, "Rezervacija sa kreiranim ID-em ne postoji u bazi.");
        $this->assertEquals($this->userId, $reservation['user_id']);
        $this->assertEquals($this->roomId, $reservation['room_id']);
        $this->assertEquals('200.00', $reservation['total_price']);
    }

    // Brisanje probnih podataka (ON DELETE CASCADE rešava zavisnosti u tvojoj bazi)
    protected function tearDown(): void
    {
        if ($this->countryId) {
            $this->pdo->exec("DELETE FROM country WHERE id = {$this->countryId}");
        }
        if ($this->userId) {
            $this->pdo->exec("DELETE FROM users WHERE id = {$this->userId}");
        }
    }
}