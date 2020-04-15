<?php
class Session{

    public static function logOut(){
        session_destroy();
        unset($_SESSION['loggedin']);
        unset($_SESSION['email']);
        unset($_SESSION['name']);
    }
}