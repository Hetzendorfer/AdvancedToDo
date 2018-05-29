<?php

class Group{
    
    public static function getDepartment(){
        
    }
    
    public static function getInformation($id){
        $db = new Database();
        $conn = $db->getConnection();
        
        $query = "SELECT gruppe.id AS ID, gruppe.abteilung_id AS DEPARTMENT_ID, gruppe.name AS NAME, gruppe.bezeichnung AS DESCRIPTION FROM gruppe WHERE gruppe.id = :id;";
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
                "DEPARTMENT_ID" => $DEPARTMENT_ID
            );
            
            array_push($array, $item);
        }
        return $array;
    }
    
    public static function getToDo($id){
        $db = new Database();
        $conn = $db->getConnection();
        
        $query = "SELECT gruppe_todo.id AS ID, gruppe_todo.beschreibung AS DESCRIPTION, gruppe_todo.auftragsdatum AS STARTDATE, gruppe_todo.enddatum AS ENDDATE, gruppe_todo.aktiv AS ACTIV FROM gruppe_todo WHERE gruppe_todo.aktiv = 1 AND gruppe_todo.gruppe_id = :id;";
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
}

