<?php

class Config{
    public static function getUrl(){
        if(!isset($_GET["url"])){
            $uri = $_SERVER["REQUEST_URI"];
            $arr = explode("?", $uri);
            $uri = $arr[0];
            $_GET["url"] = ltrim($uri, '/');
            if(isset($arr[1])){
                $query = explode("&", $arr[1]);
                foreach ($query as $key => $value) {
                    $items = explode("=", $value);
                    $_GET[$items[0]] = $items[1];
                }
            }
        }
    }
}


?>