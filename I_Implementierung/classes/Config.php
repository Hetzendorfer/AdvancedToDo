<?php

class Config{
    public static function getUrl(){
        if(!isset($_GET["url"])){
            $uri = $_SERVER["REQUEST_URI"];
            $_GET["url"] = ltrim($uri, '/');
        }
    }
}


?>