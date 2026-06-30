<?php

class hotelModel {
  private PDO $db;

  public function __construct(PDO $dbConnection){
    $this->db=$dbConnection;
  }

  public function homeViewRooms () {

    $queryRoom="SELECT room_image.image as 'room_image',room_image.path as 'room_path',room.id,room.pricePerNight, room.type,room.description,room.beds,room.balcony,country.name as 'nameCo',city.name as 'nameCi',location.address 
            FROM room inner join room_image
            on room.id=room_image.room_id
            inner join hotel
            on hotel.id=room.hotel_id
            inner join hotel_image
            on hotel.id=hotel_image.hotel_id
            inner join location
            on hotel.location_id=location.id
            inner join city
            on location.city_id=city.id
            inner join country
            on city.country_id = country.id
          WHERE room.id NOT IN (
          SELECT room_id from reservation
          where reservation.check_in<=CURDATE() and reservation.check_out>=CURDATE()) 
          group by room_image.room_id
          having min(room_image.room_id)";

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
