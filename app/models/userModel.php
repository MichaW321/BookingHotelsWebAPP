<?php

class userModel {
  private PDO $db;

  // Constructor that accepts connection to database as argument
  public function __construct(PDO $dbConnection){
    $this->db=$dbConnection;
  }

  public function existsUser($username,$email) {
    // We are using prepared statement to prevent SQL injection
    $stmt=$this->db->prepare("SELECT id FROM users WHERE username = :username OR email = :email");
    $stmt->execute([
      ':username' => $username,
      ':email' => $email 
    ]);

    // IF that we can write in 1 line of code , it looks cooler and simpler.
    return $stmt->fetch() ? true : false;
  }

  public function insertUser($username,$first_name,$last_name,$email,$password) {
    $stmt=$this->db->prepare("INSERT INTO users (username,first_name,last_name,email,password) VALUES
    (:username,:first_name,:last_name,:email,:password)");

    $hashedPassword=password_hash($password,PASSWORD_ARGON2ID);

    $result=$stmt->execute([
      ':username'=> $username,
      ':first_name'=> $first_name,
      ':last_name'=> $last_name,
      ':email'=> $email,
      ':password'=> $hashedPassword
    ]);

    return $result;
  }

  public function getUserByUsername($username) {
    $stmt=$this->db->prepare("SELECT id,password FROM users WHERE username = :username");
    $stmt->execute([':username' => $username]);
    return $stmt->fetch();
  }
}

?>