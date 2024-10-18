<?php 

require_once 'config.php';
class User_model {
    private $db;

    public function __construct() {
        $this->db = new PDO(
            "mysql:host=".MYSQL_HOST.";dbname=".MYSQL_DB.";charset=utf8", 
            MYSQL_USER, 
            MYSQL_PASS
        );
    }

    public function getUserByUserName($nombre_usuario) {
        $query = $this->db->prepare('SELECT * FROM usuarios WHERE nombre_usuario = ?');
        $query->execute([$nombre_usuario]);

        $user = $query->fetch(PDO::FETCH_OBJ);

        return $user;
    }

    public function addUser($nombre, $nombre_usuario, $contraseñaEncrip) {
        $query = $this->db->prepare('INSERT INTO usuarios (nombre, nombre_usuario, contraseña) VALUES (?,?,?)');
        $query->execute([$nombre, $nombre_usuario, $contraseñaEncrip]);
    }
}