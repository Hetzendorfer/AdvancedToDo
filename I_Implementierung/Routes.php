<?php


Route::set("auth", function() {
    
    Authentication::Route();
    
});

Route::set("dashboard", function() {
    
    if(isset($_COOKIE["token"])){
        if(Authentication::Authenticate($_COOKIE["token"]))
            UserView::showView();
    }
    else{
        if(isset($_POST["email"], $_POST["password"])){
                $token = Authentication::Login($_POST["email"], $_POST["password"]);
                if($token != NULL){
                    setcookie("token", $token);
                    UserView::showView();
                }
                else{
                    $_SERVER["error"] = true;
                    Login::showView();
                }
        }
        else{
            $_SERVER["error"] = true;
            Login::showView();
        }
    }
});

Route::set("logout", function() {

    setcookie("token", "", time()-1);
    
    header('Location: http://localhost:8000/login');
    
});

Route::set("enterprise", function(){
    $bool = true;
    if(isset($_COOKIE["token"])){
        if(Authentication::Authenticate($_COOKIE["token"])){
            $bool = false;
            Enterprise::getInformation();
        }
    }
    if($bool){
        $_SERVER["token_error"] = true;
        Login::showView();
    }
        
});

Route::set("enterprise/todo", function(){
    $bool = true;
    if(isset($_COOKIE["token"])){
        if(Authentication::Authenticate($_COOKIE["token"])){
            $bool = false;
            Enterprise::getToDo();
        }
    }
    if($bool){
        $_SERVER["token_error"] = true;
        Login::showView();
    }
    
});

Route::set("login", function() {

    Login::showView();
    
});

Route::set("", function() {

    Login::showView();
    
});


?>
