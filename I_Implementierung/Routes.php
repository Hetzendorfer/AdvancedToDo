<?php


Route::set("auth", function() {

    echo "Authentication";
    
});

Route::set("login", function(){

    include_once './classes/Views/login.php';
    
});
Route::set("", function(){

    include_once './classes/Views/login.php';
    
});


?>
