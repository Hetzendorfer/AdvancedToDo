<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <style>
            table tr td{
                display: inline-block;
                margin-left: 10px;
                margin-right: 10px;
            }
        </style>
    </head>
    <body>
        <h1>
            Hier werden zukünftig alle ToDos aufgezeigt werden!
        </h1>
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
    </body>
</html>
