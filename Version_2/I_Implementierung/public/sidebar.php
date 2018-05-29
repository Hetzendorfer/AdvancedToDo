
<nav class="col-md-2 d-none d-md-block bg-light sidebar">              
    <ul>
        <li id="dashboard">
            <a href="http://localhost:8000/dashboard" class="sidebar-link"><svg class="sidebar-img"xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>Dashboard
            </a>
        </li>
        <li>
            <a href="http://localhost:8000/dashboard/employee" class="sidebar-link"><img src="http://localhost:8000/public/css/svg/person.svg" class="sidebar-img">Meine ToDos</a>
        </li>
        <li>
            <a href="#" class='sidebar-link'><img src='http://localhost:8000/public/css/svg/home.svg' class='sidebar-img'>Unternehmen</a>
        </li>
        <?php
            if(isset($_SERVER["is_management"]) && $_SERVER["is_management"] == true){
                $enterpriseID;
                if(isset($_SERVER["user_id"]))
                    $enterpriseID = Employee::getEnterprise($_SERVER["user_id"])["ENTERPRISE_ID"];
                else 
                    $enterpriseID = Employee::getEnterprise($_COOKIE["user_id"])["ENTERPRISE_ID"];
                $departments = Enterprise::getDepartments($enterpriseID);
                
                for($i = 0; $i < count($departments); $i++){
                    echo "  <li>
                                <a href='#' class='sidebar-link'><img src='http://localhost:8000/public/css/svg/briefcase.svg' class='sidebar-img'> " . $departments[$i]["DEPARTMENT_NAME"] . "</a>
                            </li>";
                }
            }
            else if(isset($_COOKIE["is_management"]) && $_COOKIE["is_management"] == true){
                $enterpriseID;
                if(isset($_SERVER["user_id"]))
                    $enterpriseID = Employee::getEnterprise($_SERVER["user_id"])["ENTERPRISE_ID"];
                else 
                    $enterpriseID = Employee::getEnterprise($_COOKIE["user_id"])["ENTERPRISE_ID"];
                $departments = Enterprise::getDepartments($enterpriseID);
                
                for($i = 0; $i < count($departments); $i++){
                    echo "  <li>
                                <a href='#' class='sidebar-link'><img src='http://localhost:8000/public/css/svg/briefcase.svg' class='sidebar-img'>" . $departments[$i]["DEPARTMENT_NAME"] . "</a>
                            </li>";
                }
            }
            else{
                $info;
                if(isset($_SERVER["user_id"]))
                    $info = Employee::getInformation($_SERVER["user_id"]);
                else 
                    $info = Employee::getInformation($_COOKIE["user_id"]);
                
                $infoItem = $info[0];
                if($infoItem["DEPARTMENT_ID"] != NULL)
                    echo "  <li>
                                <a href='#'>Abteilung</a>
                            </li>";
            }
        ?>
        
    </ul>
</nav>