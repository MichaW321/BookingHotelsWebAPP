<?php

class hotelModel {
  private PDO $db;

  public function __construct(PDO $dbConnection){
    $this->db=$dbConnection;
  }

  public function homeViewRooms () {

    $queryRoom="SELECT * FROM room INNER JOIN room_image ON room.id=room_image.room_id GROUP BY room.id HAVING min(room_image.id) limit 8";

    $stmt=$this->db->query($queryRoom);
    
    return $stmt->fetchAll();

  }

  public function homeViewHotels () {

    $queryRoom="SELECT * FROM hotel INNER JOIN hotel_image
    WHERE hotel.id=hotel_image.hotel_id";

    $stmt=$this->db->query($queryRoom);
    
    return $stmt->fetchAll();

  }
}

?>
