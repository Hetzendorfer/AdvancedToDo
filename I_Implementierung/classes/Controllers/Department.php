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
}

