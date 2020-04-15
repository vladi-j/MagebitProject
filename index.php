<?php

session_start();

spl_autoload_register(function($class){
    if(file_exists('./classes/'.$class.'.php')){
        require_once './classes/'.$class.'.php';
    } else if(file_exists('./Controllers/'.$class.'.php')){
        require_once './Controllers/'.$class.'.php';
    }
});

require_once('Routes.php');