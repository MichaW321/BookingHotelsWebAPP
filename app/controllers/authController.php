<?php 

class authController{

  private userModel $user;

  public function __construct(PDO $db){
    $this->user=new userModel($db);
  }
  
  public function register() {
    if($this->isLoggedIn()){
      header("Location: index.php?action=home");
      exit;
    }
    
    if($_SERVER['REQUEST_METHOD']=='POST'){
      
     $username=trim($_POST['username']);
     $firstName=trim($_POST['first-name']);
     $lastName=trim($_POST['last-name']);
     $email=trim($_POST['email']);
     $password=$_POST['password'];
     $confirmPassword=$_POST['confirm-password'];

     if($password!=$confirmPassword){
      $error="Passwords don't match";
      require_once '../app/views/registerView.php';
      return;
     }
     if(strlen($password)<8){
      $error="Password should be at least 8 characters";
      require_once '../app/views/registerView.php';
      return;
     }
     if (empty($username) || empty($firstName) || empty($lastName) || empty($email) || empty($password)) {
      $error="All fields are required";
      require_once '../app/views/registerView.php';
      return ;
     }

     if($this->user->existsUser($username,$email)){
      $error="User already exists";
      require_once '../app/views/registerView.php';
      return;
     }

     $result=$this->user->insertUser($username,$firstName,$lastName,$email,$password);

     if($result){
      header("Location: index?action=login.php");
      exit();
     } else { die("Problem creating new user");}
     } else {
      $this->showRegisterForm();
      }
  }


  public function showRegisterForm(){
    require_once '../app/views/registerView.php';
  }



  public function showLoginForm(){
    require_once '../app/views/loginView.php';
  }



  public function login() {

    if($this->isLoggedIn()){
      header("Location: index.php?action=home");
      exit;
    }

    if($_SERVER['REQUEST_METHOD']=='POST'){
      $username=trim($_POST['username'] ?? '');  // this is basically the same as asking if(isset())
      $password=$_POST['password'] ?? '';

      if(empty($username) || empty($password)){
        $errorLogin="Please fill out both fields";
        require_once '../app/views/loginView.php';
        return;
      }

      $modelUser=$this->user->getUserByUsername($username);
      if(($modelUser) && (password_verify($password,$modelUser['password']))) {
          $_SESSION['id']=$modelUser['id'];
          $_SESSION['username']=$modelUser['username'];

          header("Location: index.php?action=home");
          exit();
      } else {
        $errorLogin="Username and password don't match";
        require_once '../app/views/loginView.php';
        return;
      }
    } else {
      $this->showLoginForm();
    }
  }

  
  public function isLoggedIn() {
    return isset($_SESSION['id']);
  }

  
  
  public function logout() {
    if($this->isLoggedIn()){
      $_SESSION=array();
      session_destroy();
      header("Location: index.php?action=home");
      exit;
    }
    else {
      header("Location: index.php?action=home");
      exit;
    }
  }
}



?>