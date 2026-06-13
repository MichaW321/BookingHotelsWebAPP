<?php 
// A php file where we will initialize database (create tables if not exists and database)

$host='localhost';
$user='root';
$pass='';
$db='bookify';

// We pass only hostname , username,and pass to PDO because now we only have to create database
try{
  $temp=new PDO("mysql:host=$host",$user,$pass);
  $temp->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
  $temp->exec("CREATE DATABASE IF NOT EXISTS `$db` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
  echo("Success");
}
catch (PDOException $e){
  die("Error creating database: ". $e->getMessage());
}

// Now that database is created , we can require connection file since we now need to create tables
require_once 'connection.php';

$pdo=Connection::connect();

$queries=[
  "CREATE TABLE IF NOT EXISTS country (
    id INT AUTO_INCREMENT NOT NULL,
    name VARCHAR(100) NOT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB;",

"CREATE TABLE IF NOT EXISTS city (
    id INT AUTO_INCREMENT NOT NULL,
    name VARCHAR(100) NOT NULL,
    country_id INT NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (country_id) REFERENCES country(id)
) ENGINE=InnoDB;",

"CREATE TABLE IF NOT EXISTS location (
    id INT AUTO_INCREMENT NOT NULL,
    city_id INT NOT NULL,
    address VARCHAR(100) NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (city_id) REFERENCES city(id)
) ENGINE=InnoDB;",

"CREATE TABLE IF NOT EXISTS hotel (
    id INT AUTO_INCREMENT NOT NULL,
    name VARCHAR(150) NOT NULL,
    location_id int not null,
    description TEXT NOT NULL,
    type VARCHAR(100) NOT NULL,
    email varchar(100) NOT NULL,
    phone varchar(100) NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (location_id) REFERENCES location(id)
) ENGINE=InnoDB;",

  "CREATE TABLE IF NOT EXISTS hotel_image(
  id int auto_increment not null,
  image varchar(255) not null,
  hotel_id int not null,
  primary key(id),
  foreign key(hotel_id) references hotel(id)
  )Engine=InnoDB;",

  "CREATE TABLE IF NOT EXISTS room (
  id int auto_increment not null,
  beds tinyint not null,
  balcony tinyint not null,
  pricePerNight decimal(10,2) not null,
  type varchar(100) not null,
  description text not null,
  hotel_id int not null,
  primary key(id),
  foreign key(hotel_id) references hotel(id)
  )Engine=InnoDB;",

  "CREATE TABLE IF NOT EXISTS room_image(
  id int auto_increment not null,
  image varchar(255) not null,
  room_id int not null,
  primary key(id),
  foreign key(room_id) references room(id)
  )Engine=InnoDB;",

  "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT NOT NULL,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('user', 'admin', 'manager') NOT NULL DEFAULT 'user',
    PRIMARY KEY (id)
  ) ENGINE=InnoDB;",
  "CREATE TABLE IF NOT EXISTS reservation (
    id INT AUTO_INCREMENT NOT NULL,
    user_id INT NOT NULL,
    room_id INT NOT NULL,
    check_in DATE NOT NULL,
    check_out DATE NOT NULL,
    total_price DECIMAL(10,2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (room_id) REFERENCES room(id)
  ) ENGINE=InnoDB;"];
  try{
  foreach($queries as $query){
    $pdo->exec($query);
  }
  echo("Success");
}
catch(PDOException $e){
  die("Error creating tables ".$e->getMessage());
}



?>