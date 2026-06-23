<?php

class bookingModel{
  private PDO $db;

  public function __construct(PDO $dbConnection){
    $this->db=$dbConnection;
  }

  function getRoomAndHotelByID($id) {
  $query="SELECT hotel.name,hotel.description,hotel.type,hotel.email,hotel.phone,room.pricePerNight,
          room.type,room.description 
          from 
          hotel inner join room 
          on hotel.id=room.hotel_id
          inner join reservation
          on room.id=reservation.room_id
          WHERE room.id=:room_id and reservation.check_out < CURDATE()";
  

  $stmt=$this->db->prepare($query);
  $stmt->execute([':room_id'=>$id,]);

  return $stmt->fetch();
  }

   
  function getRoomAndHotelImagesByID($id) {
    $query="SELECT room_image.image as 'room_image',room_image.path as 'room_path',hotel_image.image    as   'hotel_image',hotel_image.path as 'hotel_path'
            FROM room inner join room_image
            on room.id=room_image.room_id
            inner join hotel
            on hotel.id=room.hotel_id
            inner join hotel_image
            on hotel.id=hotel_image.hotel_id
            inner join reservation
            on room.id=reservation.room_id
            where room.id=:room_id and reservation.check_out < CURDATE()";

    $stmt=$this->db->prepare($query);
    $stmt->execute([':room_id'=>$id,]);

    return $stmt->fetchAll();
  }
}

?>