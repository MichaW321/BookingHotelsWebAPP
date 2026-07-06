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
   $roomAndHotel=$this->booking->getRoomAndHotelByID($id);
   $roomImages=$this->booking->getRoomImagesByID($id); 
   $hotelImages=$this->booking->getHotelImagesByID($id);
   
   include_once '../app/views/bookingView.php';
  }

  function showConfirmForm() {
    $id=$_POST['room_id'];
    $check_in=$_POST['check_in'];
    $check_out=$_POST['check_out'];
    
    $user_id=$_SESSION['id'];


    $user=$this->booking->getUserByID($user_id);
    $roomAndHotel=$this->booking->getRoomAndHotelByID($id);
    $roomImage=$this->booking->getRoomImagesByID($id); 
    $hotelImage=$this->booking->getHotelImagesByID($id);
    
    include_once '../app/views/confirmBookingView.php';

  }
}

?>