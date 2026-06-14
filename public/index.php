<?php
require_once '../app/controllers/homeController.php';
require_once '../app/controllers/authController.php';

$action=$_GET['action'] ?? 'home';

switch($action){
    case 'home':
    $homeController= new homeController();
    $homeController->index();
    break;
    
    case 'register':
    $authController = new authController();
    $authController->showRegisterForm();
    break;
}
?>