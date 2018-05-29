<?php

class Enterprise{
    
    public static function getToDo($enterprise_id){
        $db = new Database();
        $conn = $db->getConnection();
        
        $query = "SELECT unternehmen_todo.id AS ID, unternehmen_todo.beschreibung AS DESCRIPTION, unternehmen_todo.auftragsdatum AS STARTDATE, unternehmen_todo.enddatum AS ENDDATE, unternehmen_todo.aktiv AS ACTIV FROM unternehmen_todo WHERE unternehmen_todo.aktiv = 1 AND unternehmen_todo.unternehmen_id = :enterprise_id;";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":enterprise_id", $enterprise_id);
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
    
    public static function setToDo($description, $beginDateTime, $endDateTime){
        $db = new Database();
        $conn = $db->getConnection();
        
        $query = "INSERT INTO unternehmen_todo() VALUES ();";
        $stmt = $conn->prepare($query);
        
        if($stmt->execute()){
            
        }
    }
    
    public static function addDepartment($enterprise_id, $department_name, $department_description){
        $db = new Database();
        $conn = $db->getConnection();
        
        $query = "INSERT INTO abteilung(abteilung.name, abteilung.beschreibung, abteilung.unternehmen_id) VALUES (:name, :description, :enterprise_id);";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":name", $department_name);
        $stmt->bindParam(":description", $department_description);
        $stmt->bindParam(":enterprise_id", $enterprise_id);
        
        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }
    }
    
    public static function getDepartments($enterprise_id){
        $db = new Database();
        $conn = $db->getConnection();
        
        $query = "SELECT abteilung.id AS ID, abteilung.name AS NAME FROM abteilung WHERE abteilung.unternehmen_id = :enterprise_id;";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":enterprise_id", $enterprise_id);
        $stmt->execute();
        
        if($stmt->rowCount() > 0){
            $array = array();
            
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                extract($row);
                $item = array(
                    "DEPARTMENT_ID" => $ID,
                    "DEPARTMENT_NAME" => $NAME
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

