<?php 

    function readSession($res) {
        session_start();

        if (isset($_SESSION['id_user'])) {
            $res->user = new stdClass();
            $res->user->id_usuario = $_SESSION['id_user'];  
            $res->user->nombre_usuario = $_SESSION['nombre_usuario'];
            
            return;
        }
    }