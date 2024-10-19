<?php

require_once 'app/controllers/concesionaria.controller.php';
require_once 'app/controllers/auth.controller.php';
require_once 'middlewares/read.session.auth.php';
require_once 'middlewares/verify.session.auth.php';
require_once 'list/response.php';

define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':'
    . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');

$action = 'home';
if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}

$res = new Response();

$params = explode('/', $action);

switch ($params[0]) {
    case 'home':
        readSession($res);
        $controller = new Concesionaria_controller($res);
        $controller->showMarcas();
        break;
    case 'showVehiculos':
        readSession($res);
        $controller = new Concesionaria_controller($res);
        $controller->showVehiculos();
        break;
    case 'showVehiculosPorMarca':
        readSession($res);
        $controller = new Concesionaria_controller($res);
        $controller->showVehiculos($params[1]);
        break;
    case 'showVehiculo':
        readSession($res);
        $controller = new Concesionaria_controller($res);
        $controller->showVehiculo($params[1]);
        break;
    case 'addMarca':
        readSession($res);
        verifySession($res);
        $controller = new Concesionaria_controller($res);
        $controller->addMarca();
        break;
    case 'deleteMarca':
        readSession($res);
        verifySession($res);
        $controller = new Concesionaria_controller($res);
        $controller->deleteMarca($params[1]);
        break;
    case 'confirmacionDeleteMarca':
        readSession($res);
        verifySession($res);
        $controller = new Concesionaria_controller($res);
        $controller->confirmacionDeleteMarca($params[1]);
        break;
    case 'updateFormMarca':
        readSession($res);
        verifySession($res);
        $controller = new Concesionaria_controller($res);
        $controller->showUpdateFormMarca($params[1]);
        break;
    case 'updateMarca':
        $controller = new Concesionaria_controller($res);
        $controller->updateMarca($params[1]);
        break;
    case 'addVehiculo':
        readSession($res);
        verifySession($res);
        $controller = new Concesionaria_controller($res);
        $controller->addVehiculo();
        break;
    case 'deleteVehiculo':
        readSession($res);
        verifySession($res);
        $controller = new Concesionaria_controller($res);
        $controller->deleteVehiculo($params[1]);
        break;
    case 'updateFormVehiculo':
        readSession($res);
        verifySession($res);
        $controller = new Concesionaria_controller($res);
        $controller->showUpdateFormVehiculo($params[1]);
        break;
    case 'updateVehiculo':
        readSession($res);
        verifySession($res);
        $controller = new Concesionaria_controller($res);
        $controller->updateVehiculo($params[1]);
        break;
    case 'showLogin':
        $controller = new Auth_controller($res);
        $controller->showLogin();
        break;
    case 'login':
        $controller = new Auth_controller($res);
        $controller->login();
        break;
    case 'logout':
        $controller = new Auth_controller($res);
        $controller->logout();
        break;
    case 'showSingUp':
        $controller = new Auth_controller($res);
        $controller->showSingUp();
        break;
    case 'singUp':
        $controller = new Auth_controller($res);
        $controller->singUp();
        break;
    default:
        echo '404';
        break;
}