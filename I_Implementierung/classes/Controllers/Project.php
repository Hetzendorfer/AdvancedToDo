<?php

class Project{
    
    public static function getInformation(){
        
    }
    
    public static function getToDo(){
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
}

