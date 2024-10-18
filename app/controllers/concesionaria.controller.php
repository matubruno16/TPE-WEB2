<?php

require_once './app/models/concesionaria.model.php';
require_once './app/views/concesionaria.view.php';
class Concesionaria_controller
{
    private $model;
    private $view;

    public function __construct()
    {
        $this->model = new Concesionaria_model();
        $this->view = new Concesionaria_view();
    }

    public function showMarcas()
    {
        $marcas = $this->model->getMarcas();

        $this->view->showMarcas($marcas);
    }

    public function showVehiculos($id_marca = '')
    {
        $marcas = $this->model->getMarcas();

        if ($id_marca) {
            $marca = $this->model->getMarca($id_marca);
            $vehiculos = $this->model->getVehiculosPorMarca($id_marca);

            $this->view->showVehiculos($vehiculos, $marca, $marcas= null);
            return;
        }

        $vehiculos = $this->model->getVehiculos();

        $this->view->showVehiculos($vehiculos, $marca = null, $marcas);
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



    public function deleteMarca($id_marca)
    {
        $this->model->deleteMarca($id_marca);

        header('Location: ' . BASE_URL);
    }

    public function deleteVehiculo($id_vehiculo)
    {
        $this->model->deleteVehiculo($id_vehiculo);

        header("Location: " . BASE_URL . 'showVehiculos');
    }

    public function showUpdateForm($id_marca)
    {
        $this->view->showUpdateForm($id_marca);
    }

    public function updateMarca($id_marca)
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

        $this->model->updateMarca($id_marca, $nombre, $rutaImagenFinal);

        header("Location: " . BASE_URL);
        
    }


}