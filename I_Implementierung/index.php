<?php

function __autoload($classname){
    if(file_exists("./classes/$classname.php"))
        include_once "./classes/$classname.php";
    else if(file_exists("./classes/Controllers/$classname.php"))
        include_once "./classes/Controllers/$classname.php";
    else if(file_exists("./classes/Views/$classname.php"))
        include_once "./classes/Views/$classname.php";
}

Config::getUrl();

include_once './Routes.php';

Database::$database;

if(isset(Route::$routes[$_GET["url"]]))
    Route::$routes[$_GET["url"]]->__invoke();

?>