<?php
include 'controllers/AuthController.php';
include 'controllers/LocationController.php';

$authController = new AuthController();
$lokasiController = new LocationController();

if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'login':
            $authController->login($_POST['username'], $_POST['password']);
            break;
        case 'logout':
            $authController->logout();
            break;
        case 'register':
            $authController->register($_POST['username'], $_POST['password'], $_POST['confirm_password']);
            break;
        case 'user_update':
            $authController->updateUser();
            break;
        case 'add':
            $lokasiController->addLocation(
                $_POST['name'],
                $_POST['address'],
                $_POST['phone_number'],
                $_POST['service_type'],
                $_POST['opening_hours'],
                $_POST['lat'],
                $_POST['lng']
            );
            break;
        case 'update':
            $lokasiController->updateLocation(
                $_POST['id'],
                $_POST['name'],
                $_POST['address'],
                $_POST['phone_number'],
                $_POST['service_type'],
                $_POST['opening_hours'],
                $_POST['lat'],
                $_POST['lng']
            );
            break;
        case 'delete':
            $lokasiController->deleteLocation($_GET['id']);
            break;
            
    }
}
