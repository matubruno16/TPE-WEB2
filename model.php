<?php

class Model {
    protected $db;
    public function __construct() {
        $this->db = new PDO(
            "mysql:host=".MYSQL_HOST . 
            ";dbname=".MYSQL_DB.";charset=utf8", 
            MYSQL_USER, MYSQL_PASS);
        $this->_deploy();
    }

    private function _deploy() {
        $query = $this->db->query('SHOW TABLES');
        $tables = $query->fetchAll();
        
        if (count($tables) == 0) {
            $sqlFile = 'concesionaria.sql';

            if (file_exists($sqlFile)) {
                $sql = file_get_contents($sqlFile);
                $this->db->exec($sql);
            } else {
                throw new Exception("El archivo SQL de deploy no se encontró.");
            }
        }
    }
}