<?php

use Mpdf\Mpdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class adminController {
    private bookingModel $booking;
    private userModel $user;

    public function __construct(PDO $db) {
        $this->booking = new bookingModel($db);
        $this->user = new userModel($db);
        $this->checkAdmin();
    }

    private function checkAdmin() {
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            header("Location: index.php?action=home");
            exit();
        }
    }

    public function index() {
        $reservations = $this->booking->getReservationsPaginated(20, 0, '');
        $rooms = $this->booking->getAllRooms(); // Pretpostavka da metoda vraća sve sobe
        $users = $this->user->getAllUsers();   // Pretpostavka da metoda vraća sve korisnike
        require_once '../app/views/adminDashboardView.php';
    }

    // --- USER CRUD ---
    public function updateUserRole() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = (int)$_POST['user_id'];
            $newRole = $_POST['role'];
            $this->user->updateUserRole($userId, $newRole);
            Logger::log("Promenjena uloga za korisnika ID {$userId} na '{$newRole}'.");
        }
        header("Location: index.php?action=admin");
        exit();
    }

    public function deleteUser() {
        if (isset($_GET['id'])) {
            $userId = (int)$_GET['id'];
            // Sprečavamo admina da obriše sam sebe
            if ($userId !== $_SESSION['id']) {
                Logger::log("Obrisan korisnik sa ID-em: {$userId}.");
                $this->user->deleteUser($userId);
            }
        }
        header("Location: index.php?action=admin");
        exit();
    }

    

    public function deleteRoom() {
        if (isset($_GET['id'])) {
            $roomId = (int)$_GET['id'];
            $this->booking->deleteRoom($roomId);
        }
        header("Location: index.php?action=admin");
        exit();
    }

    public function addUser() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username  = trim($_POST['username']);
        $firstName = trim($_POST['first_name']);
        $lastName  = trim($_POST['last_name']);
        $email     = trim($_POST['email']);
        $password  = $_POST['password'];
        $role      = $_POST['role'];

        if (!empty($username) && !empty($email) && !empty($password)) {
            $this->user->createUser($username, $firstName, $lastName, $email, $password, $role);
            Logger::log("Admin je kreirao novog korisnika '{$username}' sa ulogom '{$role}'.");
        }
    }
    header("Location: index.php?action=admin");
    exit();
    
}
public function exportPdf() {
    // Dohvatamo sve rezervacije za izveštaj
    $reservations = $this->booking->getReservationsPaginated(1000, 0, '');

    $html = '<h2>Izveštaj o rezervacijama - Bookify Admin</h2>';
    $html .= '<table border="1" width="100%" cellpading="5" style="border-collapse: collapse;">';
    $html .= '<thead>
                <tr style="background-color: #f2f2f2;">
                    <th>ID</th>
                    <th>Korisnik</th>
                    <th>Tip Sobe</th>
                    <th>Check In</th>
                    <th>Check Out</th>
                    <th>Cena</th>
                </tr>
              </thead><tbody>';

    foreach ($reservations as $r) {
        $html .= '<tr>';
        $html .= '<td>' . htmlspecialchars($r['id']) . '</td>';
        $html .= '<td>' . htmlspecialchars($r['username']) . '</td>';
        $html .= '<td>' . htmlspecialchars($r['room_type']) . '</td>';
        $html .= '<td>' . htmlspecialchars($r['check_in']) . '</td>';
        $html .= '<td>' . htmlspecialchars($r['check_out']) . '</td>';
        $html .= '<td>$' . htmlspecialchars($r['total_price']) . '</td>';
        $html .= '</tr>';
    }

    $html .= '</tbody></table>';

    // Generisanje PDF-a preko mPDF biblioteke
    $mpdf = new \Mpdf\Mpdf();
    $mpdf->WriteHTML($html);
    Logger::log("Generisan PDF izveštaj o rezervacijama.");
    $mpdf->Output('Izvestaj_Rezervacije.pdf', \Mpdf\Output\Destination::DOWNLOAD);
    exit();
}

public function exportExcel() {
    $reservations = $this->booking->getReservationsPaginated(1000, 0, '');

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Naslovi kolona
    $sheet->setCellValue('A1', 'ID');
    $sheet->setCellValue('B1', 'Korisnik');
    $sheet->setCellValue('C1', 'Tip Sobe');
    $sheet->setCellValue('D1', 'Check In');
    $sheet->setCellValue('E1', 'Check Out');
    $sheet->setCellValue('F1', 'Cena ($)');

    $row = 2;
    foreach ($reservations as $r) {
        $sheet->setCellValue('A' . $row, $r['id']);
        $sheet->setCellValue('B' . $row, $r['username']);
        $sheet->setCellValue('C' . $row, $r['room_type']);
        $sheet->setCellValue('D' . $row, $r['check_in']);
        $sheet->setCellValue('E' . $row, $r['check_out']);
        $sheet->setCellValue('F' . $row, $r['total_price']);
        $row++;
    }

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="Izvestaj_Rezervacije.xlsx"');
    header('Cache-Control: max-age=0');

    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');
    Logger::log("Generisan Excel izveštaj o rezervacijama.");
    exit();
}
}