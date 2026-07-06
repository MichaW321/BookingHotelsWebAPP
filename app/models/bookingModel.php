<?php

class bookingModel{
  private PDO $db;

  public function __construct(PDO $dbConnection){
    $this->db=$dbConnection;
  }

 public function isRoomBooked($id) {
    $query="SELECT room.id from room WHERE room.id=:id AND room.id NOT IN (SELECT reservation.room_id FROM reservation WHERE reservation.check_in <= CURDATE() AND reservation.check_out >=CURDATE())";

    $stmt=$this->db->prepare($query);
    $stmt->execute([':id'=>$id]);

    return $stmt->fetch() ? true : false ;
 }

 public function getRoomAndHotelByID($id){
    $query="SELECT 
            room.beds as 'room_beds',
            room.balcony as 'room_balcony',
            room.pricePerNight as 'room_price',
            room.type as 'room_type',
            room.description as 'room_description',
            hotel.name as 'hotel_name',
            hotel.description as 'hotel.description',
            hotel.type as 'hotel.type',
            hotel.email as 'hotel.email',
            hotel.phone as 'hotel.phone',
            location.address as 'address',
            city.name as 'city.name',
            country.name as 'country.name'
            from room inner join hotel
            on room.hotel_id=hotel.id
            inner join location
            on hotel.location_id = location.id
            inner join city
            on location.city_id = city.id
            inner join country
            on city.country_id = country.id
            where room.id=:id
            ";
    $stmt=$this->db->prepare($query);
    $stmt->execute([':id'=> $id]);
    return $stmt->fetch();
 }
 
  public function getRoomImagesByID($id){
  $query="SELECT
          room_image.image as 'room_image',
          room_image.path as 'room_path'
          FROM 
          room inner join room_image 
          on room.id=room_image.room_id
          where room.id=:id";

  $stmt=$this->db->prepare($query);
  $stmt->execute([':id'=>$id]);
  return $stmt->fetchAll();
 }

  public function getHotelImagesByID($id){
  $query="SELECT
          hotel_image.image as 'hotel_image',
          hotel_image.path as 'hotel_path'
          FROM 
          room inner join hotel 
          on room.hotel_id=hotel.id
          inner join hotel_image
          on hotel.id = hotel_image.hotel_id
          where room.id=:id";

  $stmt=$this->db->prepare($query);
  $stmt->execute([':id'=>$id]);
  return $stmt->fetchAll();
 }

  public function getUserByID($id){
        $query="SELECT 
        users.first_name as 'first_name',
        users.last_name as 'last_name',
        users.email as 'email' 
        FROM users 
        WHERE users.id=:id";
        
        $stmt=$this->db->prepare($query);
        $stmt->execute([':id'=>$id]);

   return $stmt->fetch();    
 }

 public function makeReservation(){
        
 }
}

?>