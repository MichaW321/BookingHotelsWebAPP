<?php

class bookingController {
  private bookingModel $booking;

  public function __construct(PDO $db) {
      $this->booking = new bookingModel($db);
  }

  function isLoggedIn(){
    return isset($_SESSION['id']);
  }

  function showBookingForm(){
    $id=$_GET['room'];

    $roomAndHotel=$this->booking->getRoomAndHotelByID($id);
    $images=$this->booking->getRoomAndHotelImagesByID($id);

    echo $id;
    echo $roomAndHotel['name'];
  }
}

?>