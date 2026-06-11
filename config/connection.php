<?php
//config/connection.php
// In this file we establish connection to database 

class Connection {
  private static $instance = null;

  private function __construct() {}

  public static function connect() {
    if(self::$instance == null) {
        $host='localhost';
        $db='bookify';
        $user='root';
        $pass='';
        $charset='utf8mb4';
        
        //Required for PDO constructor , because it takes dsn for first argument.
        $dsn="mysql:host=$host;dbname=$db;charset=$charset";

        //Key value associative array for PDO options
        $options = [
          PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
          PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
          PDO::ATTR_EMULATE_PREPARES => false,
        ];
        try{
          self::$instance=new PDO($dsn,$user,$pass,$options);
        }
        catch (PDOException $e) {
          die("Connection to database is not successful" . $e->getMessage());
        }
    }
    return self::$instance;
  }
}

?>