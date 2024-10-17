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

            $this->view->showVehiculos($vehiculos, $marcas, $marca);
            return;
        }

        $vehiculos = $this->model->getVehiculos();

        $this->view->showVehiculos($vehiculos, $marcas);
    }

    public function showVehiculo($id_vehiculo) {
        $vehiculo = $this->model->getVehiculo($id_vehiculo);
        $marcas = $this->model->getMarcas();

        $this->view->showVehiculo($vehiculo, $marcas);
        return;
    }

    // public function showVehiculosPorMarca($id_marca) {
    //     $vehiculos = $this->model->getVehiculosPorMarca($id_marca);
    //     $marca = $this->model->getMarca($id_marca);

    //     $this->view->showVehiculos($vehiculos, $marca);
    // }

    public function addMarca()
    {
        if (!isset($_POST['nombre']) || empty($_POST['nombre'])) {
            header("Location: " . BASE_URL);
            return;
        }

        if (!isset($_POST['imagen']) || empty($_POST['imagen'])) {
            header("Location: " . BASE_URL);
            return;
        }

        $nombre = $_POST['nombre'];
        $imagen = $_POST['imagen'];

        $this->model->addMarca($nombre, $imagen);

        header("Location: " . BASE_URL);
    }

    public function addVehiculo()
    {
        if (!isset($_POST['modelo']) || empty($_POST['modelo'])) {
            header("Location: " . BASE_URL);
            return;
        }

        if (!isset($_POST['marca']) || empty($_POST['marca'])) {
            header("Location: " . BASE_URL);
            return;
        }

        if (!isset($_POST['descripcion']) || empty($_POST['descripcion'])) {
            header("Location: " . BASE_URL);
            return;
        }

        if (!isset($_POST['imagen']) || empty($_POST['imagen'])) {
            header("Location: " . BASE_URL);
            return;
        }

        $modelo = $_POST['modelo'];
        $marca = $_POST['marca'];
        $descripcion = $_POST['descripcion'];
        $imagen = $_POST['imagen'];

        $this->model->addVehiculo($modelo, $marca, $descripcion, $imagen);

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

        if (!isset($_POST['imagen']) || empty($_POST['imagen'])) {
            header("Location: " . BASE_URL);
            return;
        }

        $nombre = $_POST['nombre'];
        $imagen = $_POST['imagen'];

        $this->model->updateMarca($id_marca, $nombre, $imagen);

        header("Location: " . BASE_URL);
    }


}