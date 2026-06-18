<?php
session_start();

echo "<script src='script.js'></script>";

require_once '../app/controllers/homeController.php';
require_once '../app/controllers/authController.php';

require_once '../app/models/userModel.php';

require_once '../config/database.php';

$db=Connection::connect();

$action=$_GET['action'] ?? 'home';

switch($action){
    case 'home':
    $homeController= new homeController();
    $homeController->index();
    break;
    
    case 'register':
    $authController = new authController($db);
    $authController->register();
    break;

    case 'login':
    $authController = new authController($db);    
    $authController->login();
    break;

    case 'logout':
    $authController= new authController($db);
    $authController->logout();
    break;

    case 'logoutConfirm':
    require_once '../app/views/confirmLogout.php';  
    break;
}
?>