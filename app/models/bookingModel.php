<?php

class bookingModel{
  private PDO $db;

  public function __construct(PDO $dbConnection){
    $this->db=$dbConnection;
  }

  public function loggedUser($user_id){
        $id=$_SESSION['id'];

        return $user_id==$id ? true : false;
  }

  public function isRoomFree($id,$check_in,$check_out){
    $query="SELECT *
            FROM room
            WHERE room.id = :id AND NOT EXISTS (
            SELECT 1 FROM reservation
            WHERE reservation.room_id=:id2
            AND :check_in < reservation.check_out    /* 7.12 12.12   9.12 13.12 */
            AND :check_out > reservation.check_in)";
    
    $stmt=$this->db->prepare($query);
    $stmt->execute([
        ':id'=>$id,
        ':id2'=>$id,
        ':check_in'=>$check_in,
        ':check_out'=>$check_out
    ]);
    return $stmt->fetch() ? true : false;
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

 public function getRoomByID($id){
    $query="SELECT *
            FROM room WHERE room.id = :id";
    
    $stmt=$this->db->prepare($query);
    $stmt->execute([':id'=>$id]);

    return $stmt->fetch();
 }

 public function createReservation($room,$user,$check_in,$check_out,$price){
     $query="INSERT INTO reservation (user_id,room_id,check_in,check_out,total_price)
             VALUES(:user_id,:room_id,:check_in,:check_out,:total_price)";
             
     $stmt=$this->db->prepare($query);
     $stmt->execute([
        ':user_id'=>$user,
        ':room_id'=>$room,
        ':check_in'=>$check_in,
        ':check_out'=>$check_out,
        ':total_price'=>$price
     ]);

     return $this->db->lastInsertId();
 }
 public function searchRooms($city, $check_in, $check_out){
    $query = "SELECT
              room.id as 'room_id',
              room.type as 'room_type',
              room.beds as 'room_beds',
              room.balcony as 'room_balcony',
              room.pricePerNight as 'room_price',
              hotel.name as 'hotel_name',
              city.name as 'city_name',
              country.name as 'country_name',
              (SELECT room_image.path FROM room_image
                WHERE room_image.room_id = room.id LIMIT 1) as 'room_path'
              FROM room
              INNER JOIN hotel ON room.hotel_id = hotel.id
              INNER JOIN location ON hotel.location_id = location.id
              INNER JOIN city ON location.city_id = city.id
              INNER JOIN country ON city.country_id = country.id
              WHERE city.name LIKE :city
              AND room.id NOT IN (
                  SELECT reservation.room_id FROM reservation
                  WHERE :check_in < reservation.check_out
                  AND :check_out > reservation.check_in
              )
              ORDER BY room.pricePerNight ASC";

    $stmt = $this->db->prepare($query);
    $stmt->execute([
        ':city'      => '%' . $city . '%',
        ':check_in'  => $check_in,
        ':check_out' => $check_out
    ]);

    return $stmt->fetchAll();
 }

 public function getReservationsPaginated(int $limit, int $offset, string $search = ''): array {
    $sql = "SELECT r.*, u.username, u.email, rm.type AS room_type 
            FROM reservation r 
            JOIN users u ON r.user_id = u.id 
            JOIN room rm ON r.room_id = rm.id 
            WHERE u.username LIKE :search1 OR rm.type LIKE :search2
            ORDER BY r.check_in DESC 
            LIMIT :limit OFFSET :offset";

    $stmt = $this->db->prepare($sql);
    
    $searchTerm = '%' . $search . '%';
    $stmt->bindValue(':search1', $searchTerm);
    $stmt->bindValue(':search2', $searchTerm);
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    
    $stmt->execute();

    return $stmt->fetchAll();
}
public function getTotalReservationsCount(string $search = ''): int {
    $sql = "SELECT COUNT(*) FROM reservation r 
            JOIN users u ON r.user_id = u.id 
            JOIN room rm ON r.room_id = rm.id 
            WHERE u.username LIKE :search1 OR rm.type LIKE :search2";

    $stmt = $this->db->prepare($sql);
    
    $searchTerm = '%' . $search . '%';
    $stmt->bindValue(':search1', $searchTerm);
    $stmt->bindValue(':search2', $searchTerm);
    
    $stmt->execute();
    return (int) $stmt->fetchColumn();
}
public function getAllRooms(): array {
    $stmt = $this->db->query("SELECT * FROM room ORDER BY id DESC");
    return $stmt->fetchAll();
}

public function insertRoom(string $type, float $price, int $capacity): bool {
    $stmt = $this->db->prepare("INSERT INTO room (type, pricePerNight, beds) VALUES (:type, :price, :capacity)");
    return $stmt->execute([
        ':type' => $type,
        ':price' => $price,
        ':capacity' => $capacity
    ]);
}

public function deleteRoom(int $roomId): bool {
    $stmt = $this->db->prepare("DELETE FROM room WHERE id = :id");
    return $stmt->execute([':id' => $roomId]);
}

public function createUser(string $username, string $firstName, string $lastName, string $email, string $password, string $role): bool {
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    
    $sql = "INSERT INTO users (username, first_name, last_name, email, password, role) 
            VALUES (:username, :first_name, :last_name, :email, :password, :role)";
            
    $stmt = $this->db->prepare($sql);
    return $stmt->execute([
        ':username'   => $username,
        ':first_name' => $firstName,
        ':last_name'  => $lastName,
        ':email'      => $email,
        ':password'   => $hashedPassword,
        ':role'       => $role
    ]);
}
public function deleteReservation(int $id): bool {
    $stmt = $this->db->prepare("DELETE FROM reservation WHERE id = :id");
    return $stmt->execute([':id' => $id]);
}
}


?>