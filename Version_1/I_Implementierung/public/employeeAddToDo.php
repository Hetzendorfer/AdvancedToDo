<?php
    include_once './public/header.php'; 
?>
    <body>
        <?php
            include_once './public/navbar.php';
        ?>
        <div class="container-fluid">
            <div class="row">
                <?php
                    include_once './public/sidebar.php';
                ?>
                <main class="col-md-9 ml-sm-auto col-lg-10">
                    <form action="http://localhost:8000/dashboard/employee" class="addForm" method="POST">
                        <input type="submit" value="Zurück" class="btn btn-secondary"/>
                    </form>
                    <form class="form">
                        <div class="form-group row">
                            <label for="textInput" class="col-sm-2 col-form-label">Beschreibung</label>
                            <div class="col-sm-10">
                                <textarea id="textInput" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="startInput" class="col-sm-2 col-form-label">Startdatum</label>
                            <div class="col-sm-4">
                                <input type="datetime-local" id="startInput" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="endInput" class="col-sm-2 col-form-label">Enddatum</label>
                            <div class="col-sm-4">
                                <input type="datetime-local" id="endInput" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="textInput" class="col-sm-2 col-form-label">Wichtig</label>
                            <div class="col-sm-4">
                                <input type="checkbox" id="wichtigInput" name="wichtig">
                            </div>
                        </div>
                        <?php
                        
                        $departmentID_array = Employee::getDeparmentsWhereManager($_COOKIE["user_id"]);
                        
                        if($departmentID_array != NULL){
                            $employee_arr = array();
                            
                            foreach ($departmentID_array as $key => $value) {
                                array_push($employee_arr, Department::getEmployees($value["DEPARTMENT_ID"]));
                            }
                            echo '  <div class="form-group row">
                                        <label for="textInput" class="col-sm-2 col-form-label">Mitarbeiter</label>
                                        <div class="col-sm-4">
                                        <select class="form-control">';
                            
                            for($i = 0; $i < count($employee_arr); $i++){
                                for($j = 0; $j < count($employee_arr[$i]); $j++){
                                    echo '<option value="' . $employee_arr[$i][$j]["ID"] .'">' . $employee_arr[$i][$j]["NAME"] . ' ' . $employee_arr[$i][$j]["SURNAME"] . '</option>' ;
                                }
                            }        
                            
                            echo '</select>
                                </div>
                                    </div>';
                        }
                        else if($_COOKIE["is_management"] == "true")
                            echo '  <div class="form-group row">
                                        <label for="textInput" class="col-sm-2 col-form-label">Mitarbeiter</label>
                                        <div class="col-sm-4">
                                            <input type="datetime-local" id="textInput" class="form-control">
                                        </div>
                                    </div>';
                        ?>
                    </form>
                </main>
            </div>
        </div>
    </body>
</html>
