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
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $employeeToDos = Employee::getToDo($_COOKIE["user_id"]);

                                for($i = 0; $i < count($employeeToDos); $i++){
                                    if($employeeToDos[$i]["IMPORTANCE"])
                                        echo "<tr class='table-important'>";
                                    else echo "<tr>";

                                    $str =    "<td scope='row'>" . $employeeToDos[$i]["DESCRIPTION"] . "</td>"
                                            . "<td>" . $employeeToDos[$i]["STARTDATE"] . "</td>"
                                            . "<td>" . $employeeToDos[$i]["ENDDATE"] . "</td>"
                                            . "<td>" . $employeeToDos[$i]["ACTIV"] . "</td>";

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
