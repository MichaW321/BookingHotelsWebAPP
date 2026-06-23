<?php

class homeController {
      private hotelModel $hotel;

      public function __construct(PDO $db){
        $this->hotel = new hotelModel($db); 
      }
      public function index() {
        $rooms = $this->getRooms();
        
        include_once '../app/views/homeView.php';
      }

      public function getRooms () {
      $rooms=$this->hotel->homeViewRooms();
      
      return $rooms;
      }
    }
?>