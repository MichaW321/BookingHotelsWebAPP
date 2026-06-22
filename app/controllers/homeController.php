<?php

class homeController {
      private hotelModel $hotel;

      public function __construct(PDO $db){
        $this->hotel = new hotelModel($db); 
      }
      public function index() {
        require_once '../app/views/homeView.php';
      }

      public function getRooms () {
      $rooms=$this->hotel->homeViewRooms();
      foreach ($rooms as $room) {
        echo $room['id'] .' '. $room['image'] . "</br>";
      }
    }
}
?>