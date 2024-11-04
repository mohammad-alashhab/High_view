<?php

class LogoutController
{
    public function logout() {
        session_start();


        $_SESSION = [];


        session_destroy();




        header("Location:/login");
        exit;
    }


}