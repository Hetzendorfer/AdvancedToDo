<?php


Route::set("auth", function() {
    
    Authentication::Route();
    
});

Route::set("dashboard", function() {
    if(isset($_COOKIE["token"], $_COOKIE["user_id"], $_COOKIE["is_management"])){
        if(Authentication::Authenticate($_COOKIE["token"]))
            Dashboard::showView();
        else{
            setcookie("token", "", time()-1);
            setcookie("user_id", "", time()-1);
            setcookie("is_management", "", time()-1);
            $_SERVER["token_error"] = true;
            header('Location: http://localhost:8000/login');
        }
        
    }
    else{
        if(isset($_POST["email"], $_POST["password"])){
                $token = Authentication::Login($_POST["email"], $_POST["password"]);
                if($token != NULL){
                    Dashboard::showView();
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
    setcookie("user_id", "", time()-1);
    setcookie("is_management", "", time()-1);
    
    header('Location: http://localhost:8000/login');
    
});

Route::set("dashboard/enterprise", function(){
    $bool = true;
    if(isset($_COOKIE["token"])){
        if(Authentication::Authenticate($_COOKIE["token"])){
            $bool = false;
            EnterpriseView::showView();
        }
    }
    if($bool){
        $_SERVER["token_error"] = true;
        Login::showView();
    }
        
});

Route::set("dashboard/employee", function(){
    $bool = true;
    if(isset($_COOKIE["token"])){
        if(Authentication::Authenticate($_COOKIE["token"])){
            $bool = false;
            EmployeeView::showView();
        }
    }
    if($bool){
        $_SERVER["token_error"] = true;
        Login::showView();
    }
    
});
Route::set("employees/todo", function(){
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST, DELETE OPTIONS");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    switch($_SERVER["REQUEST_METHOD"])
    {
        case "POST":
            if(isset($_POST["id"], $_POST["target_id"], $_POST["startdate"], $_POST["enddate"], $_POST["importance"], $_POST["description"])){
                if(Employee::addToDo($_POST["target_id"], $_POST["id"], $_POST["description"], $_POST["startdate"], $_POST["enddate"], $_POST["importance"])){
                    http_response_code(200);
                    echo json_encode(array("success" => "true", "message" => "Creation was successfull"));
                }
                else{
                    http_response_code(400);
                    echo json_encode(array("success" => "false", "message" => "Creation was not successfull"));
                }
            }
            else{
                http_response_code(400);
                echo json_encode(array("success" => "false", "message" => "Some parameters were absent"));
            }
            break;
        case "DELETE":
            $arr = json_decode(file_get_contents("php://input"));
            if(isset($arr->todo_id, $arr->user_id)){
                if(Employee::ownsToDo($arr->user_id, $arr->todo_id) && Employee::deleteToDo($arr->todo_id)){
                    echo json_encode(array("success" => "true", "message" => "Creation was successfull"));
                }
                else{
                    http_response_code(400);
                    echo json_encode(array("success" => "false", "message" => "Creation was not successfull"));
                }
            }
            else{
                http_response_code(400);
                echo json_encode(array("success" => "false", "message" => "Some parameters were absent"));
            }
            break;
        case "OPTIONS":
            break;
        default:
            http_response_code(405);
            echo json_encode(array("success" => "false", "message" => "Request method is not allowed"));
            break;
    }
    
});

Route::set("enterprise/departments", function(){
    
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST, OPTIONS");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    switch($_SERVER["REQUEST_URI"]){
        case "POST":
            $arr = json_decode(file_get_contents("php://input"));
    
            if(isset($_GET["id"], $arr->department_name, $arr->department_description)){
                if(Enterprise::addDepartment($_GET["id"], $arr->department_name, $arr->department_description)){
                    http_response_code(200);
                    echo json_encode(array("success" => "true", "message" => "Creation was successfull"));
                }
                else{
                    http_response_code(400);
                    echo json_encode(array("success" => "false", "message" => "Creation was not succesfull"));
                }
            }
            else{
                http_response_code(400);
                    echo json_encode(array("success" => "false", "message" => "Missing parameters!"));
            }
            break;
        case "OPTIONS":
            break;
        default:
            http_response_code(405);
            echo json_encode(array("success" => "false", "message" => "Request method is not allowed"));
            break;
    }
    
    
});

Route::set("departments/employees", function(){

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST, OPTIONS");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    switch($_SERVER["REQUEST_URI"]){
        case "POST":
            $arr = json_decode(file_get_contents("php://input"));
    
            if(isset($_GET["id"], $arr->employee_id)){
                if(Department::addEmployee($_GET["id"], $arr->employee_id)){
                    http_response_code(200);
                    echo json_encode(array("success" => "true", "message" => "Creation was successfull"));
                }
                else{
                    http_response_code(400);
                    echo json_encode(array("success" => "false", "message" => "Creation was not succesfull"));
                }
            }
            else{
                http_response_code(400);
                echo json_encode(array("success" => "false", "message" => "Missing parameters!"));
            }
            
            break;
        case "OPTIONS":
            break;
        default:
            http_response_code(405);
            echo json_encode(array("success" => "false", "message" => "Request method is not allowed"));
            break;
    }
});
Route::set("departments/manager", function(){

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: GET, DELETE, POST, OPTIONS");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    switch($_SERVER["REQUEST_URI"]){
        case "GET":
            if(isset($_GET["id"])){
                $info = Department::getManager($_GET["id"]);
                if($info != NULL){
                    http_response_code(200);
                    echo json_encode($info);
                }
                else{
                    http_response_code(400);
                    echo json_encode(array("success" => "false", "message" => "No Managers!"));
                }
            }
            else{
                http_response_code(400);
                echo json_encode(array("success" => "false", "message" => "Missing parameters!")); 
            }
            break;
        case "POST":
            $arr = json_decode(file_get_contents("php://input"));
            
            if(isset($_GET["id"], $arr->employee_id, $arr->titel)){
                if(Department::addManager($_GET["id"], $arr->employee_id, $arr->titel)){
                    http_response_code(200);
                    echo json_encode(array("success" => "true", "message" => "Creation was successfull!"));
                }
                else{
                    http_response_code(400);
                    echo json_encode(array("success" => "false", "message" => "Creation was not successfull!"));
                }
            }
            else{
                http_response_code(400);
                echo json_encode(array("success" => "false", "message" => "Missing parameters!"));
            }
            break;
        case "DELETE":
            $arr = json_decode(file_get_contents("php://input"));
            
            if(isset($_GET["id"], $arr->employee_id)){
                if(Department::deleteManager($_GET["id"], $arr->employee_id)){
                    http_response_code(200);
                    echo json_encode(array("success" => "true", "message" => "Deletion was successfull!"));
                }
                else{
                    http_response_code(400);
                    echo json_encode(array("success" => "false", "message" => "Deletion was not successfull!"));
                }
            }
            else{
                http_response_code(400);
                echo json_encode(array("success" => "false", "message" => "Missing parameters!"));
            }
            break;
        case "OPTIONS":
            break;
        default:
            http_response_code(405);
            echo json_encode(array("success" => "false", "message" => "Request method is not allowed"));
            break;
    }
    
});

Route::set("dashboard/employee/addToDo", function(){

    EmployeeToDoView::showView();
    
});
        
Route::set("login", function() {

    Login::showView();
    
});

Route::set("", function() {

    Login::showView();
    
});


?>
