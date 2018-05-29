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
                <main class="col-md-9 ml-sm-auto px-4">
                    <h1>Dashboard</h1>
                    
                    
                </main>
            </div>
        </div>
        
        <script>
            $("#dashboard .sidebar-img").addClass("active");
            $("#dashboard .sidebar-link").addClass("active");
        </script>
    </body>
</html>
