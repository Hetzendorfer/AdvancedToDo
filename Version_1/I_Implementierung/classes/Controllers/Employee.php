<?php

class Employee{
    
    public static function getInformation($id){
        $db = new Database();
        $conn = $db->getConnection();
        
        $query = "SELECT mitarbeiter.vorname AS NAME, mitarbeiter.nachname AS SURNAME, mitarbeiter.projekt_id AS PROJECT_ID, mitarbeiter.abteilung_id AS DEPARTMENT_ID FROM mitarbeiter WHERE mitarbeiter.id = :id;";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        
        $array = array();
        
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $item = array(
                "NAME" => $NAME,
                "SURNAME" => $SURNAME,
                "DEPARTMENT_ID" => $DEPARTMENT_ID,
                "PROJECT_ID" => $PROJECT_ID
            );
            
            array_push($array, $item);
        }
        return $array;
    }
    
    public static function getToDo($id){
        $db = new Database();
        $conn = $db->getConnection();
        
        $query = "SELECT mitarbeiter_todo.id AS ID, mitarbeiter_todo.beschreibung AS DESCRIPTION, mitarbeiter_todo.auftragsdatum AS STARTDATE, mitarbeiter_todo.enddatum AS ENDDATE, mitarbeiter_todo.aktiv AS ACTIV, mitarbeiter_todo.wichtigkeit AS IMPORTANCE FROM mitarbeiter_todo WHERE mitarbeiter_todo.aktiv = 1 AND mitarbeiter_todo.mitarbeiter_id = :id;";
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
                "ACTIV" => $ACTIV,
                "IMPORTANCE" => $IMPORTANCE
            );
            
            array_push($array, $item);
        }
        return $array;
    }
    
    public static function addToDo($target_id, $creater_id, $description, $startdate, $enddate, $importance){
        $db = new Database();
        $conn = $db->getConnection();
        
        $query = "INSERT INTO mitarbeiter_todo "
                . "(mitarbeiter_todo.beschreibung, mitarbeiter_todo.auftragsdatum, mitarbeiter_todo.enddatum, mitarbeiter_todo.aktiv, mitarbeiter_todo.auftraggeber_id, mitarbeiter_todo.mitarbeiter_id, mitarbeiter_todo.wichtigkeit)"
                . " VALUES (:description, :startdate, :enddate, 1, :creator_id, :target_id, :importance);";
        $stmt = $conn->prepare($query);
        
        $stmt->bindParam(":creator_id", $creater_id);
        $stmt->bindParam(":target_id", $target_id);
        $stmt->bindParam(":description", $description);
        $stmt->bindParam(":startdate", $startdate);
        $stmt->bindParam(":enddate", $enddate);
        $stmt->bindParam(":importance", $importance);
        
        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }
    }
    
    public static function endToDo($employee_id, $todo_id, $result, $description){
        
        $db = new Database();
        $conn = $db->getConnection();
        
        $query = "SELECT mitarbeiter_todo.id FROM mitarbeiter_todo WHERE mitarbeiter_todo.id = :todo_id AND mitarbeiter_todo.mitarbeiter_id = :employee_id;";
        $stmt = $conn->prepare();
        $stmt->bindParam(":todo_id", $todo_id);
        $stmt->bindParam(":employee_id", $employee_id);
        $stmt->execute();
        
        if($stmt->rowCount() > 0){
            $query = "INSERT INTO mitarbeiter_todo_ende (mitarbeiter_todo_ende.ergebnis, mitarbeiter_todo_ende.beschreibung, mitarbeiter_todo_ende.ist_enddatum, mitarbeiter_todo_ende.mitarbeiter_todo_id) VALUES (:result, :description, :real_enddate, :todo_id);
                        UPDATE mitarbeiter_todo SET mitarbeiter_todo.aktiv = 0 WHERE mitarbeiter_todo.id = :todo_id2;";
            $stmt = $conn->prepare($query);
            
            $stmt->bindParam(":result", $result);
            $stmt->bindParam(":description", $description);
            $stmt->bindParam(":todo_id", $todo_id);
            $stmt->bindParam(":todo_id2", $todo_id);
            $stmt->bindParam("real_enddate", date(DateTime::W3C));
            
            if($stmt->execute()){
                return true;
            }
            else{
                return false;
            }
        }
        else{
            
        }
    }
    
    public static function getDeparmentsWhereManager($employee_id){
        $db = new Database();
        $conn = $db->getConnection();
        
        $query = "SELECT abteilungs_leiter.abteilung_id AS DEPARTMENT_ID FROM abteilungs_leiter WHERE abteilungs_leiter.mitarbeiter_id = :employee_id;";
        $stmt = $conn->prepare($query);
        
        $stmt->bindParam(":employee_id", $employee_id);
        $stmt->execute();
        
        if($stmt->rowCount() > 0){
            $array = array();
            
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                extract($row);
                $item = array(
                    "DEPARTMENT_ID" => $DEPARTMENT_ID
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

