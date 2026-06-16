<?php 

class authController{

  private userModel $user;

  public function __construct(PDO $db){
    $this->user=new userModel($db);

  }

  public function showRegisterForm(){
    require_once '../app/views/registerView.php';
  }
  
  public function register() {
    if($_SERVER['REQUEST_METHOD']=='POST'){
      
     $username=trim($_POST['username']);
     $firstName=trim($_POST['first-name']);
     $lastName=trim($_POST['last-name']);
     $email=trim($_POST['email']);
     $password=$_POST['password'];
     $confirmPassword=$_POST['confirm-password'];

     if($password!=$confirmPassword){
      die("Passwords don't match");
     }
     if(strlen($password)<8){
      die("Password should be at least 8 characters");
     }
     if (empty($username) || empty($firstName) || empty($lastName) || empty($email) || empty($password)) {
      die("All fields are required");
     }

     if($this->user->existsUser($username,$email)){
      die("User already exists");
     }

     $result=$this->user->insertUser($username,$firstName,$lastName,$email,$password);

     if($result){
      header("Location: index.php");
      exit();
     } else { die("Problem creating new user");}
     } else {$this->showRegisterForm();}
  }

}

?>