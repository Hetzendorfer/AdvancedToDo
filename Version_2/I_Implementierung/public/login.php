<?php
    $bool = true;
    if(isset($_COOKIE["token"], $_COOKIE["user_id"], $_COOKIE["is_management"])){
        if(Authentication::Authenticate($_COOKIE["token"])){
            header('Location: http://localhost:8000/dashboard');
            $bool = false;
        }
        
    }
    if($bool){
?>

<?php
include_once './public/header.php';
?>
    <body>
        <?php
            if(isset($_SERVER["error"]))
                echo "<p>Die E-Mail oder das Passwort ist nicht korrekt!</p>";
            if(isset($_SERVER["token_error"]))
                echo "<p>Der Token ist inkorrekt oder abgelaufen! Bitte logge dich erneut ein</p>";
        ?>
        <div class="container">
            <form action="http://localhost:8000/dashboard" method="POST" class="form login-form">
                <div class="login-bar">
                    AdvancedToDo
                </div>
                <div class="login-content">
                    <div class="form-row">
                        <div class="form-group col-sm">
                            <label for="emailFormInput">Email: </label>
                            <input type="email" class="form-control" placeholder="name@example.com" id="emailFormInput" name="email"/>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-sm">
                            <label for="passwortFormInput">Passwort: </label>
                            <input type="password"  class="form-control" placeholder="12345" id="passwortFormInput" name="password"/>
                        </div>
                    </div>

                    <input type="submit" class="btn mb-2 submit" name="submit" value="Anmelden"/>
                </div>
            </form>
        </div>
        
    </body>
</html>

<?php
    }
?>
