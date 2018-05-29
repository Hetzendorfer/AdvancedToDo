<?php

class Project{
    
    public static function getInformation(){
        
    }
    
    public static function getToDo($id){
        $db = new Database();
        $conn = $db->getConnection();
        
        $query = "SELECT projekt_todo.id AS ID, projekt_todo.beschreibung AS DESCRIPTION, projekt_todo.auftragsdatum AS STARTDATE, projekt_todo.enddatum AS ENDDATE, projekt_todo.aktiv AS ACTIV FROM projekt_todo WHERE projekt_todo.aktiv = 1 AND projekt_todo.projekt_id = :id;";
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
    
    public static function createProject($name, $description, $status, $activ, $employee_id){
        $db = new Database();
        $conn = $db->getConnection();
        
        $query = "INSERT INTO projekt(projekt.name, projekt.beschreibung, projekt.status, projekt.aktiv, projekt.projektleiter_id) VALUES (:name, :description, :status, :activ, :employee_id);";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":employee_id", $employee_id);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":description", $description);
        $stmt->bindParam(":status", $status);
        $stmt->bindParam(":activ", $activ);
        $stmt->bindParam(":employee_id", $employee_id);
        
        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }
    }
    public static function changeManager($project_id, $employee_id){
        
    }
    public static function addDepartment($project_id, $department_id){
        $db = new Database();
        $conn = $db->getConnection();
        
        $query = "INSERT INTO abteilung_projekt(abteilung_projekt.abteilung_id, abteilung_projekt.projekt_id) VALUES (:department_id, :project_id);";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":department_id", $department_id);
        $stmt->bindParam("project_id", $project_id);
        
        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }
    }
    public static function deleteDepartment($project_id, $department_id){
        $db = new Database();
        $conn = $db->getConnection();
        
        $query = "DELETE abteilung_projekt WHERE abteilung_projekt.abteilung_id = :department_id, abteilung_projekt.projekt_id = :project_id);";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":department_id", $department_id);
        $stmt->bindParam("project_id", $project_id);
        
        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }
    }
    public static function getDepartments($project_id){
        $db = new Database();
        $conn = $db->getConnection();
        
        $query = "SELECT abteilung.name AS NAME FROM abteilung JOIN abteilung_projekt ON abteilung_projekt.ABTEILUNG_ID = abteilung.id WHERE abteilung_projekt.PROJEKT_ID = :project_id;";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":project_id", $project_id);
        $stmt->execute();
        
        if($stmt->rowCount() > 0){
            
            $array = array();
            
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                extract($row);
                $item = array(
                    "NAME" => $NAME
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

