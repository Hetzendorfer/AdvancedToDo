<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        
        <h1>
            <?php
                $enterpriseInfo = Enterprise::getInformation()
            ?>
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
