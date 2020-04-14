<?php
class Session{

    function __construct(){
        if(empty($_SESSION['loggedin'])){
            Session::logIn();
        };
        if (isset($_GET['logout'])) {
            Session::logOut();
        };
    }

    public function logIn(){
        header("location: auth.php");
    }

    public function logOut(){
        session_destroy();
        unset($_SESSION['loggedin']);
        unset($_SESSION['email']);
        unset($_SESSION['name']);
        header("location: auth.php");
    }
}