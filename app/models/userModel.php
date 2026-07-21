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
    $stmt=$this->db->prepare("SELECT id,username,role,password FROM users WHERE username = :username");
    $stmt->execute([':username' => $username]);
    return $stmt->fetch();
  }
public function getAllUsers(): array {
    $stmt = $this->db->query("SELECT id, username, first_name, last_name, email, role FROM users ORDER BY id DESC");
    return $stmt->fetchAll();
}

public function updateUserRole(int $userId, string $role): bool {
    $stmt = $this->db->prepare("UPDATE users SET role = :role WHERE id = :id");
    return $stmt->execute([':role' => $role, ':id' => $userId]);
}

public function deleteUser(int $userId): bool {
    try {
        // 1. Prvo brišemo sve njegove rezervacije da zadovoljimo strani ključ
        $stmtRes = $this->db->prepare("DELETE FROM reservation WHERE user_id = :user_id");
        $stmtRes->execute([':user_id' => $userId]);

        // 2. Sada brišemo korisnika
        $stmtUser = $this->db->prepare("DELETE FROM users WHERE id = :id");
        return $stmtUser->execute([':id' => $userId]);
    } catch (PDOException $e) {
        return false;
    }
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
}

?>