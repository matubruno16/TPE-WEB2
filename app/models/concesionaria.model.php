<?php

class Concesionaria_model {
    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;'.'dbname=concesionaria;charset=utf8', 'root', '');
    }

    public function getMarcas() {
        $query = $this->db->prepare('SELECT * FROM marcas');
        $query->execute();

        $marcas = $query->fetchAll(PDO::FETCH_OBJ);

        return $marcas;
    }

    public function getVehiculos() {
        $query = $this->db->prepare('SELECT * FROM vehiculos');
        $query->execute();

        $vehiculos = $query->fetchAll(PDO::FETCH_OBJ);

        return $vehiculos;
    }

    public function getVehiculosPorMarca($id_marca) {
        $query = $this->db->prepare('SELECT * FROM vehiculos WHERE marca = ?');
        $query->execute([$id_marca]);

        $vehiculos = $query->fetchAll(PDO::FETCH_OBJ);

        return $vehiculos;
    }

    public function getMarca($id_marca) {
        $query = $this->db->prepare('SELECT * FROM marcas WHERE id_marca = ?');
        $query->execute([$id_marca]);

        $marca = $query->fetch(PDO::FETCH_OBJ);

        return $marca;
    }

    public function getVehiculo($id_vehiculo) {
        $query = $this->db->prepare('SELECT * FROM vehiculos WHERE id_vehiculo = ?');
        $query->execute([$id_vehiculo]);

        $vehiculo = $query->fetch(PDO::FETCH_OBJ);

        return $vehiculo;
    }

    public function addMarca($nombre, $imagen) {
        $query = $this->db->prepare('INSERT INTO marcas (nombre, imagen) VALUES (?,?)');
        $query->execute([$nombre, $imagen]);
        
    }

    public function addVehiculo($modelo, $marca, $descripcion, $imagen) {
        $query = $this->db->prepare('INSERT INTO vehiculos (modelo, marca, descripcion, imagen) VALUES (?,?,?,?)');
        $query->execute([$modelo, $marca, $descripcion, $imagen]);
        
    }

    public function deleteMarca($id_marca) {
        $query = $this->db->prepare('DELETE FROM marcas WHERE id_marca = ?');
        $query->execute([$id_marca]);
    }

    public function deleteVehiculo($id_vehiculo) {
        $query = $this->db->prepare('DELETE FROM vehiculos WHERE id_vehiculo = ?');
        $query->execute([$id_vehiculo]);
    }

    public function updateMarca($id_marca, $nombre, $imagen) {
        $query = $this->db->prepare('UPDATE marcas SET nombre = ?, imagen = ? WHERE marcas.id_marca = ?');
        $query->execute([$nombre, $imagen, $id_marca]);
    }

}