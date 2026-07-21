<?php
session_start();
ob_start();

echo '<script src="script.js"></script>';

require_once __DIR__ . '/../vendor/autoload.php';


require_once '../app/controllers/homeController.php';
require_once '../app/controllers/authController.php';
require_once '../app/controllers/bookingController.php';
require_once '../app/controllers/searchController.php';
require_once '../app/controllers/adminController.php';
require_once '../app/controllers/managerController.php';
require_once '../app/helpers/logger.php';

require_once '../app/models/userModel.php';
require_once '../app/models/hotelModel.php';
require_once '../app/models/bookingModel.php';

require_once '../config/database.php';

$db=Connection::connect();

$action=$_GET['action'] ?? 'home';

switch($action){
    case 'home':
    $homeController= new homeController($db);
    $homeController->index();
    break;
    
    case 'admin':
        require_once '../app/controllers/adminController.php';
        $adminCtrl = new adminController($db);
        $adminCtrl->index();
    break;

    case 'adminExportPdf':
        require_once '../app/controllers/adminController.php';
        $adminCtrl = new adminController($db);
        $adminCtrl->exportPdf();
    break;

    case 'adminExportExcel':
        require_once '../app/controllers/adminController.php';
        $adminCtrl = new adminController($db);
        $adminCtrl->exportExcel();
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

    case 'book':
    $bookingController= new bookingController($db);
    if(!($bookingController->isLoggedIn())){
        header("Location: index.php?action=login");
        exit;
    }
    $bookingController->showBookingForm();
    break;

    case 'confirmBooking' :
    $bookingController = new bookingController($db);
    if(!($bookingController->isLoggedIn())){
        header("Location: index.php?action=login");
        exit;
    }
    $bookingController->showConfirmForm();    
    break;

    case 'privacy' :
    require_once '../app/views/privacyPolicyView.php';
    break;

    case 'terms':
    require_once '../app/views/termsView.php';
    break;

    case 'finalizeBooking':
    $bookingController = new bookingController($db);
    $result = $bookingController->newReservation();

    if ($result['success']) {
        $_SESSION['success_booking'] = $result;
        header('Location: index.php?action=confirmation');
        exit;
    } else {
        $errorBooking = $result['error'];
        $bookingController->showConfirmFormWithError($errorBooking);
    }
    break;

    case 'confirmation':
    if (empty($_SESSION['success_booking'])){
        header('Location: index.php?action=home');
        exit;
    }
    $result=$_SESSION['success_booking'];
    unset($_SESSION['success_booking']);
    require_once '../app/views/confirmationView.php';
    break;

    case 'search':
    $searchController = new searchController($db);
    $searchController->showSearched();
    break;

    case 'about':
        require_once '../app/views/about.php';
    break;

case 'adminUpdateRole':
    (new adminController($db))->updateUserRole();
    break;
case 'adminDeleteUser':
    (new adminController($db))->deleteUser();
    break;
case 'adminDeleteRoom':
    (new adminController($db))->deleteRoom();
    break;
case 'adminAddUser':
    require_once '../app/controllers/adminController.php';
    (new adminController($db))->addUser();
    break;
case 'manager':
    (new managerController($db))->index();
    break;

case 'managerDeleteReservation':
    (new managerController($db))->deleteReservation();
    break;
    default:
        header('Location: index.php?action=home');
        exit;
}
?>