<?php

require_once './app/models/concesionaria.model.php';
require_once './app/views/concesionaria.view.php';
class Concesionaria_controller
{
    private $model;
    private $view;

    public function __construct($res) {
        $this->model = new Concesionaria_model();
        $this->view = new Concesionaria_view($res->user);
    }

    public function showMarcas()
    {
        $marcas = $this->model->getMarcas();

        $this->view->showMarcas($marcas);
    }

    public function showVehiculos($id_marca = ''){
        $marcas = $this->model->getMarcas();
        
        if ($id_marca) {
            $vehiculos = $this->model->getVehiculosPorMarca($id_marca);
        } else {
            $vehiculos = $this->model->getVehiculos();
        }

        foreach ($vehiculos as &$vehiculo) {
            foreach ($marcas as $marca) {
                if ($marca->id_marca == $vehiculo->marca) {
                    $vehiculo->nombreMarca = $marca->nombre; 
                    break;
                }
            }
        }
        $this->view->showVehiculos($vehiculos, $marcas);
    }


    public function showVehiculo($id_vehiculo) {
        $vehiculo = $this->model->getVehiculo($id_vehiculo);
        $marcas = $this->model->getMarcas();

        $this->view->showVehiculo($vehiculo, $marcas);
        return;
    }

    public function showVehiculosPorMarca($id_marca) {
        $vehiculos = $this->model->getVehiculosPorMarca($id_marca);
        $marca = $this->model->getMarca($id_marca);

        $this->view->showVehiculos($vehiculos, $marca);
    }

    public function addMarca()
    {
        if (!isset($_POST['nombre']) || empty($_POST['nombre'])) {
            header("Location: " . BASE_URL);
            return;
        }

        $nombre = $_POST['nombre'];
        $rutaImagenFinal = 'img/vehiculos/default.png';   

        if (
            isset($_FILES['imagen']) && $_FILES['imagen']['error'] === 0 &&
            ($_FILES['imagen']['type'] == "image/jpg" ||
                $_FILES['imagen']['type'] == "image/jpeg" ||
                $_FILES['imagen']['type'] == "image/png")
        ) {
            $rutaImagenTemporal = $_FILES['imagen']['tmp_name'];
            $extensionImagen = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
            $nombreImagen = uniqid() . "." . $extensionImagen;
            $rutaImagenFinal = 'img/vehiculos/' . $nombreImagen;
    
            if (!move_uploaded_file($rutaImagenTemporal, $rutaImagenFinal)) {
                $rutaImagenFinal = 'img/vehiculos/default.png';
            }
        }

        $this->model->addMarca($nombre, $rutaImagenFinal);

        header("Location: " . BASE_URL);
    }

    public function addVehiculo()
    {

        if (
            !isset($_POST['modelo']) || empty($_POST['modelo']) ||
            !isset($_POST['marca']) || empty($_POST['marca']) ||
            !isset($_POST['descripcion']) || empty($_POST['descripcion'])
        ) {
            header("Location: " . BASE_URL);
            return;
        }

        $modeloVehiculo = $_POST['modelo'];
        $marcaVehiculo = $_POST['marca'];
        $descripcionVehiculo = $_POST['descripcion'];

        $rutaImagenFinal = 'img/vehiculos/default.png';

        if (
            isset($_FILES['imagen']) && $_FILES['imagen']['error'] === 0 &&
            ($_FILES['imagen']['type'] == "image/jpg" ||
                $_FILES['imagen']['type'] == "image/jpeg" ||
                $_FILES['imagen']['type'] == "image/png")
        ) {

            $rutaImagenTemporal = $_FILES['imagen']['tmp_name'];
            $extensionImagen = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
            $nombreImagen = uniqid() . "." . $extensionImagen;
            $rutaImagenFinal = 'img/vehiculos/' . $nombreImagen;


            if (!move_uploaded_file($rutaImagenTemporal, $rutaImagenFinal)) {
                $rutaImagenFinal = 'img/vehiculos/default.png';
            }
        }

        $this->model->addVehiculo($modeloVehiculo, $marcaVehiculo, $descripcionVehiculo, $rutaImagenFinal);

        header("Location: " . BASE_URL . 'showVehiculos');
    }

    public function confirmacionDeleteMarca($id_marca){
        $this->view->confirmacionDeleteMarca($id_marca);
    }
    
    public function deleteMarca($id_marca)    {
        
        $this->model->deleteMarca($id_marca);

        header('Location: ' . BASE_URL);
    }

    public function deleteVehiculo($id_vehiculo)
    {
        $this->model->deleteVehiculo($id_vehiculo);

        header("Location: " . BASE_URL . 'showVehiculos');
    }

    public function showUpdateFormMarca($id_marca)
    {
        $marca = $this->model->getMarca($id_marca);
        $this->view->showUpdateFormMarca($id_marca, $marca);
    }
    public function showUpdateFormVehiculo($id_vehiculo)
    {
        $vehiculo = $this->model->getVehiculo($id_vehiculo);
        $marcas = $this->model->getMarcas();  
        $this->view->showUpdateFormVehiculo($vehiculo, $marcas);
    }

    public function updateMarca($id_marca)    {
        if (!isset($_POST['nombre']) || empty($_POST['nombre'])) {
            header("Location: " . BASE_URL);
            return;
        }
        
        $nombre = $_POST['nombre'];
        $rutaImagenFinal = 'img/vehiculos/default.png';   

        if (
            isset($_FILES['imagen']) && $_FILES['imagen']['error'] === 0 &&
            ($_FILES['imagen']['type'] == "image/jpg" ||
                $_FILES['imagen']['type'] == "image/jpeg" ||
                $_FILES['imagen']['type'] == "image/png")
        ) {
            $rutaImagenTemporal = $_FILES['imagen']['tmp_name'];
            $extensionImagen = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
            $nombreImagen = uniqid() . "." . $extensionImagen;
            $rutaImagenFinal = 'img/vehiculos/' . $nombreImagen;
    
            if (!move_uploaded_file($rutaImagenTemporal, $rutaImagenFinal)) {
                $rutaImagenFinal = 'img/vehiculos/default.png';
            }
        }

        $this->model->updateMarca($id_marca, $nombre, $rutaImagenFinal);

        header("Location: " . BASE_URL);
    }

    public function updateVehiculo($id_vehiculo)    {
        if (!isset($_POST['modelo']) || empty($_POST['modelo'])) {
            header("Location: " . BASE_URL . 'updateFormVehiculo/' . $id_vehiculo);
            return;
        }
        if (!isset($_POST['marca']) || empty($_POST['marca'])) {
            header("Location: " . BASE_URL . 'updateFormVehiculo/' . $id_vehiculo);
            return;
        }
        if (!isset($_POST['descripcion']) || empty($_POST['descripcion'])) {
            header("Location: " . BASE_URL . 'updateFormVehiculo/' . $id_vehiculo);
            return;
        }
        
        $modelo = $_POST['modelo'];
        $marca = $_POST['marca'];
        $descripcion = $_POST['descripcion'];
        $rutaImagenFinal = 'img/vehiculos/default.png';   

        if (
            isset($_FILES['imagen']) && $_FILES['imagen']['error'] === 0 &&
            ($_FILES['imagen']['type'] == "image/jpg" ||
                $_FILES['imagen']['type'] == "image/jpeg" ||
                $_FILES['imagen']['type'] == "image/png")
        ) {
            $rutaImagenTemporal = $_FILES['imagen']['tmp_name'];
            $extensionImagen = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
            $modeloImagen = uniqid() . "." . $extensionImagen;
            $rutaImagenFinal = 'img/vehiculos/' . $modeloImagen;
    
            if (!move_uploaded_file($rutaImagenTemporal, $rutaImagenFinal)) {
                $rutaImagenFinal = 'img/vehiculos/default.png';
            }
        }

        $this->model->updateVehiculo($id_vehiculo, $modelo, $marca, $descripcion, $rutaImagenFinal);

        header("Location: " . BASE_URL . 'showVehiculo/' . $id_vehiculo);
        
    }


}