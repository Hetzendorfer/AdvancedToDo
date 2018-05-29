<?php
    include_once './public/header.php';
?>
    <body>
        <script src="http://localhost:8000/public/js/deleteEmployeeToDo.js"></script>
        <?php
            include_once './public/navbar.php';
        ?>
        <div class="container-fluid">
            <div class="row">
                <?php
                    include_once './public/sidebar.php';
                ?>
                <main class="col-md-9 ml-sm-auto col-lg-10">
                    <form action="http://localhost:8000/dashboard/employee/addToDo" method="POST" class="addForm">
                        <input type="submit" class="btn btn-success" value="Hinzufügen"/>
                    </form>
                    <table class="table">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Beschreibung</th>
                                <th scope="col">Startdatum</th>
                                <th scope="col">Enddatum</th>
                                <th scope="col">abgeschlossen</th>
                                <th scope="col">Aktionen</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $employeeToDos = Employee::getToDo($_COOKIE["user_id"]);

                                for($i = 0; $i < count($employeeToDos); $i++){
                                    if($employeeToDos[$i]["IMPORTANCE"])
                                        echo "<tr class='table-important' id='". $employeeToDos[$i]["ID"]. "'>";
                                    else echo "<tr data-id='". $employeeToDos[$i]["ID"]. "'>";

                                    $str =    "<td scope='row'>" . $employeeToDos[$i]["DESCRIPTION"] . "</td>"
                                            . "<td>" . $employeeToDos[$i]["STARTDATE"] . "</td>"
                                            . "<td>" . $employeeToDos[$i]["ENDDATE"] . "</td>"
                                            . "<td>" . $employeeToDos[$i]["ACTIV"] . "</td>"
                                            . "<td><button class='btn aktion-btn' onClick='deleteToDo(" . $employeeToDos[$i]["ID"] . ", " . $_COOKIE["user_id"] . ");'><img class='ocitcon' src='http://localhost:8000/public/css/svg/trashcan.svg'></button>"
                                            . "<button class='btn aktion-btn'><img class='ocitcon' src='http://localhost:8000/public/css/svg/pencil.svg'></button></td>";

                                    echo $str;


                                    echo "</tr>";
                                }
                            ?>
                        </tbody>
                    </table>
                </main>
            </div>
        </div>
        
    </body>
</html>
