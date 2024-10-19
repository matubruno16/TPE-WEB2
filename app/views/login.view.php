<?php

class Login_view {
    private $user = null;

    public function __construct($user = null) {
        $this->user = $user;
    }
    public function showLogin($error = '') {
        require_once 'templates/login.form.phtml';
    }

    public function showSingUp($error = ''){
        require_once 'templates/singUp.form.phtml';
    }
}