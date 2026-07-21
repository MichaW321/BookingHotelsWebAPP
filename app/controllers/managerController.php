<?php

class managerController {
    private bookingModel $booking;

    public function __construct(PDO $db) {
        $this->booking = new bookingModel($db);
        $this->checkManager();
    }

    private function checkManager() {
        // Dozvoljavamo i adminu i manageru pristup
        if (!isset($_SESSION['role']) || !in_array($_SESSION['role'], ['manager', 'admin'])) {
            header("Location: index.php?action=home");
            exit();
        }
    }

    public function index() {
        $page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
        $limit = 10; // Broj rezervacija po stranici
        $offset = ($page - 1) * $limit;
        $search = isset($_GET['search']) ? trim($_GET['search']) : '';

        // Dohvatamo rezervacije i ukupan broj za paginaciju
        $reservations = $this->booking->getReservationsPaginated($limit, $offset, $search);
        $totalReservations = $this->booking->getTotalReservationsCount($search);
        $totalPages = ceil($totalReservations / $limit);

        require_once '../app/views/managerDashboardView.php';
    }

    public function deleteReservation() {
        if (isset($_GET['id'])) {
            $id = (int)$_GET['id'];
            $this->booking->deleteReservation($id);
            Logger::log("Otkazana/Obrisana rezervacija ID: {$id}.");
        }
        header("Location: index.php?action=manager");
        exit();
    }
}