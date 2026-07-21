<?php
class searchController{
  private bookingModel $booking;

  public function __construct(PDO $db){
    $this->booking = new bookingModel($db);
  }

  public function showSearched(){
    $city     = trim($_GET['city'] ?? '');
    $check_in = $_GET['check_in'] ?? '';
    $check_out= $_GET['check_out'] ?? '';

    $inDate  = DateTime::createFromFormat('Y-m-d', $check_in);
    $outDate = DateTime::createFromFormat('Y-m-d', $check_out);

    // Fall back to a wide-open date range if the user didn't search by date,
    // so a plain city search still returns results.
    if (!$inDate || $inDate->format('Y-m-d') !== $check_in) {
        $check_in = date('Y-m-d');
    }
    if (!$outDate || $outDate->format('Y-m-d') !== $check_out || $check_out <= $check_in) {
        $check_out = date('Y-m-d', strtotime($check_in . ' +1 day'));
    }

    $rooms = $this->booking->searchRooms($city, $check_in, $check_out);

    include_once '../app/views/searchResultsView.php';
  }
}
?>