<?php
spl_autoload_register(function($class){
    switch($class){
        case "errors":
            require_once 'Controller/errors.php';
        break;
        case "Validation":
            require_once 'Controller/Validation.php';
        break;
        case "DB":
            require_once 'Model/DB.php';
        break;
        case "DBConfig":
            require_once 'Model/DBConfig.php';
        break;
    }
});
?>