<?php

class Route {
    
    public static $routes = array();
    
    public static function set($route, $function){
        self::$routes[$route] = $function;
    }
    
}
