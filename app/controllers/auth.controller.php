<?php
    require_once './app/models/user.model.php';
    require_once './app/views/login.view.php';

class Auth_controller {
    private $model; private $view;

    public function __construct($res) {
        $this->model = new User_model();
        $this->view = new Login_view($res->user);
    }

    public function showLogin() {
        $this->view->showLogin();
    }

    public function showSingUp() {
        $this->view->showSingUp();
    }

    public function login() {
        if ((!isset($_POST['nombre_usuario'])) || (empty($_POST['nombre_usuario']))) {
            return $this->view->showLogin('Falta el nombre_usuario');
        }
        if ((!isset($_POST['contraseña'])) || (empty($_POST['contraseña']))) {
            return $this->view->showLogin('Falta la contraseña');
        }

        $nombre_usuario = $_POST['nombre_usuario'];
        $contraseña = $_POST['contraseña'];

        $user = $this->model->getUserByUserName($nombre_usuario);

        if (!$user) {
            return $this->view->showLogin('No existe el usuario');

        } else if (password_verify($contraseña, $user->contraseña)) {
            session_start();
            $_SESSION['id_user'] = $user->id_usuario;
            $_SESSION['nombre_usuario'] = $user->nombre_usuario;

            header('Location: ' . BASE_URL);
        } else {
            return $this->view->showLogin('Contraseña Incorrecta');
        }
    }

    public function logout() {
        session_start(); // Va a buscar la cookie
        session_destroy(); // Borra la cookie que se buscó
        header("Location: " . BASE_URL . "showLogin");
    }

    public function singUp() {
        if ((!isset($_POST['nombre'])) || (empty($_POST['nombre']))) {
            return $this->view->showSingUp('Falta el nombre');
        }
        if ((!isset($_POST['nombre_usuario'])) || (empty($_POST['nombre_usuario']))) {
            return $this->view->showSingUp('Falta el nombre_usuario');
        }
        if ((!isset($_POST['contraseña'])) || (empty($_POST['contraseña']))) {
            return $this->view->showSingUp('Falta la contraseña');
        }

        $nombre = $_POST['nombre'];
        $nombre_usuario = $_POST['nombre_usuario'];
        $contraseña = $_POST['contraseña'];

        $contraseñaEncrip = password_hash($contraseña, PASSWORD_DEFAULT);

        $this->model->addUser($nombre, $nombre_usuario, $contraseñaEncrip);

        header("Location: " . BASE_URL . 'showLogin');
    }
}