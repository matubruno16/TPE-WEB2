<?php

class Login_view {
    public function showLogin($error = '') {
        require_once 'templates/login.form.phtml';
    }

    public function showSingUp($error = ''){
        require_once 'templates/singUp.form.phtml';
    }
}