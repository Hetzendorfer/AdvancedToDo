<?php

class Authentication{
    
    public static function Route(){
        
        switch($_SERVER["REQUEST_METHOD"]){
            case 'GET':
                if(isset($_GET["email"], $_GET["password"])){
                    $token = self::Login($_GET["email"], $_GET["password"]);
                    if($token != NULL){
                        http_response_code(200);
                        echo json_encode(array(
                            "token" => $token
                        ));
                    }
                    else{
                        http_response_code(400);
                        echo json_encode(array(
                            "message" => "Login data is wrong"
                        ));
                    }
                }
                else{
                    http_response_code(400);
                        echo json_encode(array(
                            "message" => "Missing Arguments"
                        ));
                }
                break;
            case 'POST':
                $token = self::Authenticate($_GET["token"]);
                if($token != NULL){
                    http_response_code(200);
                    echo json_encode(array(
                        "token" => $token
                    ));
                }
                else{
                    http_response_code(401);
                    echo json_encode(array(
                        "message" => "Token not valid"
                    ));
                }
                    
                break;
            case 'OPTIONS':
                echo "options";
                break;
            default:
                echo "default";
                break;
        }
        
    }
    
    public static function Authenticate($token){
        $db = new Database();
        $conn = $db->getConnection();
        
        self::deleteOldSessions($conn);
        
        $query = "SELECT * FROM sessions WHERE sessions.sessions_token = :token;";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":token", $token);
        $stmt->execute();
        
        if($stmt->rowCount() == 1){
           return $token; 
        }
        else
            return NULL;
    }
    
    public static function Login($email, $password){
        $db = new Database();
        $conn = $db->getConnection();
        
        self::deleteOldSessions($conn);
        
        $query = "SELECT login_daten.mitarbeiter_id, login_daten.is_management FROM login_daten WHERE login_daten.email = :email AND login_daten.password = :password;";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":password", $password);
        $stmt->execute();
        
        if($stmt->rowCount() > 0){
            $query = "INSERT INTO sessions (sessions.sessions_token, sessions.sessions_date) VALUES (:token, :date);";
            $stmt = $conn->prepare($query);
            
            
            $token = self::GetToken();
            $date = date(DateTime::W3C);
            $date = new DateTime($date);
            $date->modify('+1 hour');
            $date = date_format($date, DateTime::W3C);
            
            $stmt->bindParam(":token", $token);
            $stmt->bindParam(":date", $date);
            
            if($stmt->execute()){
                return $token;
            }
            
            else
            {
                return NULL;
            }
        }
        
    }
    
    private static function deleteOldSessions($conn){
        $query = "DELETE FROM sessions WHERE sessions.sessions_date < :date";
        $stmt = $conn->prepare($query);
        
        $date = date(DateTime::W3C);
        $stmt->bindParam(":date", $date);
        $stmt->execute();
    }
    
    private static function GetToken(){
        
        
        $charArr = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z');
        
        $randomString = "";
        
        for($i = 0; $i < 32; $i++){
            $randomString .= $charArr[rand(0, 25)];
        }
        
        
        return hash('sha256', $randomString);   
    }
}

?>

