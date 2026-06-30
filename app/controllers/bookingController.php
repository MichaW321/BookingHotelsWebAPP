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
    if(!($this->booking->isRoomBooked($id))){
      header("Location: index.php?action=home");
      exit();
    }
   $roomsAndHotels=$this->booking->getRoomAndHotelByID($id);
   $roomImage=$this->booking->getRoomImagesByID($id); 
   $hotelImage=$this->booking->getHotelImagesByID($id);
   
   include_once '../app/views/bookingView.php';
  }
}

?>