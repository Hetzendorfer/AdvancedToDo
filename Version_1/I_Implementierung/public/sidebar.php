
<nav class="col-md-2 d-none d-md-block bg-light sidebar">              
    <ul>
        <li>
            <a href="http://localhost:8000/dashboard">Dashboard</a>
        </li>
        <li>
            <a href="http://localhost:8000/dashboard/employee">Meine ToDos</a>
        </li>
        <li>
            <a href="http://localhost:8000/dashboard/enterprise">Unternehmen</a>
        </li>
        <?php
            $info;
            if(isset($_SERVER["user_id"]))
                $info = Employee::getInformation($_SERVER["user_id"]);
            if(isset($_COOKIE["user_id"]))
                $info = Employee::getInformation($_COOKIE["user_id"]);
        
            $infoItem = $info[0];
            if($infoItem["DEPARTMENT_ID"] != NULL)
                echo "  <li>
                            <a href='#'>Abteilung</a>
                        </li>";
            if($infoItem["PROJECT_ID"] != NULL)
                echo "  <li>
                        <a href='#'>Projekt</a>
                        </li>";
        ?>
        
    </ul>
</nav>