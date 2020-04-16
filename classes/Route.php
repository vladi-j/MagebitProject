<?php

class Route {
    public static $validRoutes = array("index.php", "Validate", "saveAttributes", "logout");
    public static function set($route, $function){
        if($_GET['url'] == $route){
            $function->__invoke();
        };

        //If route doesn't exist redirect to authentication page
        if(!in_array($_GET['url'],self::$validRoutes)){
            Auth::CreateView('Auth');
        }
    }
}