<?php

class Department{
    
    public static function getInformation($id){
        $db = new Database();
        $conn = $db->getConnection();
        
        $query = "SELECT abteilung.id AS ID, abteilung.name AS NAME, abteilung.beschreibung AS DESCRIPTION, abteilung.unternehmen_id AS ENTERPRISE_ID FROM abteilung WHERE abteilung.id = :id;";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        
        $array = array();
        
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $item = array(
                "ID" => $ID,
                "NAME" => $NAME,
                "DESCRIPTION" => $DESCRIPTION,
                "ENTERPRISE_ID" => $ENTERPRISE_ID
            );
            
            array_push($array, $item);
        }
        return $array;
    }
    
    public static function getToDo($id){
        $db = new Database();
        $conn = $db->getConnection();
        
        $query = "SELECT abteilung_todo.id AS ID, abteilung_todo.beschreibung AS DESCRIPTION, abteilung_todo.auftragsdatum AS STARTDATE, abteilung_todo.enddatum AS ENDDATE, abteilung_todo.aktiv AS ACTIV FROM abteilung_todo WHERE abteilung_todo.aktiv = 1 AND abteilung_todo.abteilung_id = :id;";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        
        $array = array();
        
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $item = array(
                "ID" => $ID,
                "DESCRIPTION" => $DESCRIPTION,
                "STARTDATE" => $STARTDATE,
                "ENDDATE" => $ENDDATE,
                "ACTIV" => $ACTIV
            );
            
            array_push($array, $item);
        }
        return $array;
    }
    
    public static function getProject(){
        
    }
    
    public static function addEmployee($department_id, $employee_id){
        $db = new Database();
        $conn = $db->getConnection();
        
        $query = "UPDATE mitarbeiter SET mitarbeiter.abteilung_id = :department_id WHERE mitarbeiter.id = :employee_id;";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":department_id", $department_id);
        $stmt->bindParam(":employee_id", $employee_id);
        
        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }
    }
    
    public static function addManager($department_id, $employee_id, $titel){
        
        $db = new Database();
        $conn = $db->getConnection();
        
        $query = "INSERT INTO abteilungs_leiter(abteilungs_leiter.abteilung_id, abteilungs_leiter.mitarbeiter_id, abteilungs_leiter.titel) VALUES (:department_id, :employee_id, :titel);";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":department_id", $department_id);
        $stmt->bindParam(":employee_id", $employee_id);
        $stmt->bindParam(":titel", $titel);
        
        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }
    }
    
    public static function deleteManager($department_id, $employee_id){
        $db = new Database();
        $conn = $db->getConnection();
        
        $query = "DELETE abteilungs_leiter where abteilungs_leiter.abteilung_id = :department_id, abteilungs_leiter.mitarbeiter_id = :employee_id;";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":department_id", $department_id);
        $stmt->bindParam(":employee_id", $employee_id);
        
        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }
    }
    
    public static function getManager($department_id){
        $db = new Database();
        $conn = $db->getConnection();
        
        $query = "";
        $stmt = $conn->prepare($query);
        $stmt->bindParam();
        $stmt->execute();
        if($stmt->rowCounr() > 0){
            
        }
        else{
            
        }
    }
    
    public static function isManager($department_id, $employee_id){
        $db = new Database();
        $conn = $db->getConnection();
        $query = "SELECT abteilungs_leiter.titel AS TITEL FROM abteilungs_leiter WHERE abteilungs_leiter.abteilung_id = :department_id AND abteilungs_leiter.mitarbeiter_id = :employee_id;";
        
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":department_id", $department_id);
        $stmt->bindParam(":employee_id", $employee_id);
        $stmt->execute();
        
        if($stmt->rowCount() > 0){
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row["TITEL"];
        }
        else{
            return NULL;
        }
    }
    
    public static function getEmployees($department_id){
        $db = new Database();
        $conn = $db->getConnection();
        $query = "SELECT mitarbeiter.id AS ID, mitarbeiter.vorname AS NAME, mitarbeiter.nachname AS SURNAME FROM mitarbeiter WHERE mitarbeiter.abteilung_id = :department_id;";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":department_id", $department_id);
        $stmt->execute();
        
        if($stmt->rowCount() > 0){
            
            $array = array();
            
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                extract($row);
                $item = array(
                    "ID" => $ID,
                    "NAME" => $NAME,
                    "SURNAME" => $SURNAME
                );
                
                array_push($array, $item);
            }
            
            return $array;
        }
        else{
            return NULL;
        }
    }
}

