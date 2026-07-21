<?php

use PHPUnit\Framework\TestCase;

class UserRegistrationTest extends TestCase
{
    private $pdo;
    private $insertedUserId;

    protected function setUp(): void
    {
        $host = 'db';
        $db   = 'bookify';
        $user = 'root';
        $pass = '';

        $this->pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    }

    // TEST: Registracija novog korisnika i provera heširane lozinke
    public function testUserCanBeRegisteredWithHashedPassword()
    {
        $username  = 'milan_test';
        $firstName = 'Milan';
        $lastName  = 'Milanović';
        $email     = 'milan_' . time() . '@example.com'; // Unikatan email
        $plainPass = 'Sifra123!';
        
        // Simuliramo tvoj PHP kod pri registraciji (password_hash)
        $hashedPass = password_hash($plainPass, PASSWORD_BCRYPT);

        // Upis u tvoju 'users' tabelu
        $stmt = $this->pdo->prepare("
            INSERT INTO users (username, first_name, last_name, email, password) 
            VALUES (:username, :first_name, :last_name, :email, :password)
        ");

        $executed = $stmt->execute([
            ':username'   => $username,
            ':first_name' => $firstName,
            ':last_name'  => $lastName,
            ':email'      => $email,
            ':password'   => $hashedPass
        ]);

        $this->insertedUserId = $this->pdo->lastInsertId();

        // --- PROVERE (ASSERTIONS) ---

        // 1. Proveravamo da li je korisnik uspešno kreiran u bazi
        $this->assertTrue($executed, "Registracija korisnika nije uspela.");
        $this->assertGreaterThan(0, $this->insertedUserId, "Baza nije vratila validan user ID.");

        // 2. Izvlačimo korisnika iz baze
        $selectStmt = $this->pdo->prepare("SELECT * FROM users WHERE id = :id");
        $selectStmt->execute([':id' => $this->insertedUserId]);
        $userInDb = $selectStmt->fetch();

        // 3. Provera default uloge ('user') iz tvoje sheme
        $this->assertEquals('user', $userInDb['role'], "Default uloga mora biti 'user'.");

        // 4. Bezbednosna provera: Lozinka u bazi NE SMETO DA BUDE običan tekst
        $this->assertNotEquals($plainPass, $userInDb['password'], "Lozinka ne sme biti upisana kao čisti tekst!");
        
        // 5. Proveravamo da li `password_verify` prepoznaje dobru šifru iz heša
        $this->assertTrue(password_verify($plainPass, $userInDb['password']), "Lozinka iz baze mora odgovarati originalnoj unetoj šifri.");
    }

    // Čišćenje probnog korisnika iz baze nakon izvođenja testa
    protected function tearDown(): void
    {
        if ($this->insertedUserId) {
            $this->pdo->exec("DELETE FROM users WHERE id = {$this->insertedUserId}");
        }
    }
}