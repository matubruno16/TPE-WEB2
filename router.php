<?php 

require_once 'app/controllers/concesionaria.controller.php';

define('BASE_URL','//'.$_SERVER['SERVER_NAME'].':'
.$_SERVER['SERVER_PORT'].dirname($_SERVER['PHP_SELF']).'/');

$action = 'home';
if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}

$params = explode('/', $action);

switch ($params[0]) {
    case 'home':
        $controller = new Concesionaria_controller();
        $controller->showMarcas();
        break;
    case 'showVehiculos':
        $controller = new Concesionaria_controller();
        $controller->showVehiculos();
        break;
    case 'showVehiculosPorMarca':
        $controller = new Concesionaria_controller();
        $controller->showVehiculos($params[1]);
        break;
    case 'showVehiculo' :
        $controller = new Concesionaria_controller();
        $controller->showVehiculo($params[1]);
        break;
    case 'addMarca':
        $controller = new Concesionaria_controller();
        $controller->addMarca();
        break;
    case 'deleteMarca':
        $controller = new Concesionaria_controller();
        $controller->deleteMarca($params[1]);
        break;
    case 'updateFormMarca':
        $controller = new Concesionaria_controller();
        $controller->showUpdateForm($params[1]);
        break;
    // case 'updateMarca':
    //     $controller = new Concesionaria_controller();
    //     $controller->updateMarca($params[1]);
    //     break;
    case 'addVehiculo':
        $controller = new Concesionaria_controller();
        $controller->addVehiculo();
        break;
    case 'deleteVehiculo':
        $controller = new Concesionaria_controller();
        $controller->deleteVehiculo($params[1]);
        break;
    // case 'updateVehiculo':
    //     $controller = new Concesionaria_controller();
    //     $controller->updateVehiculo($params[1]);
    //     break;
    default:
        echo '404';
        break;
}