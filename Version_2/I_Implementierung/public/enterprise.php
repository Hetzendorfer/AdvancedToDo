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
                <main class="col-md-9 ml-sm-auto col-lg-10 px-4">
                    <table>
                        <tr>
                            <td>Beschreibung</td>
                            <td>Startdatum</td>
                            <td>Enddatum</td>
                            <td>abgeschlossen</td>
                        </tr>
                        <?php
                            $enterpriseToDos = Enterprise::getToDo();

                            for($i = 0; $i < count($enterpriseToDos); $i++){
                                echo "<tr>";

                                $str =    "<td>" . $enterpriseToDos[$i]["DESCRIPTION"] . "</td>"
                                        . "<td>" . $enterpriseToDos[$i]["STARTDATE"] . "</td>"
                                        . "<td>" . $enterpriseToDos[$i]["ENDDATE"] . "</td>"
                                        . "<td>" . $enterpriseToDos[$i]["ACTIV"] . "</td>";

                                echo $str;


                                echo "</tr>";
                            }
                        ?>
                    </table>
                </main>
            </div>
        </div>
    </body>
</html>
