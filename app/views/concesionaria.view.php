<?php

class Concesionaria_view {
    private $user = null;

    public function __construct($user = '') {
        $this->user = $user;
    }

    public function showMarcas($marcas, $error = '') {
        require_once 'templates/marcas.lista.phtml';
    }

    public function showUpdateForm($id_marca) {
        require_once 'templates/marcas.update.form.phtml';
    }

    public function showVehiculos($vehiculos, $marcas, $marca = '') {
        require_once 'templates/vehiculos.lista.phtml';
    }

    public function showVehiculo($vehiculo, $marcas) {
        require_once 'templates/vehiculo.detalle.phtml';
    }
}