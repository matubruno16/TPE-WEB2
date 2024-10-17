<?php

class Concesionaria_view {
    

    public function showMarcas($marcas, $error = '') {
        require_once 'templates/marcas.lista.phtml';
    }

    public function showUpdateForm($id_marca) {
        require_once 'templates/marcas.update.form.phtml';
    }

    public function showVehiculos($vehiculos, $marcas, $marca = '') {
        require_once 'templates/vehiculos.lista.phtml';
    }
}