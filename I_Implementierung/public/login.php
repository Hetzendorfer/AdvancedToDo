<?php
    $bool = true;
    if(isset($_COOKIE["token"])){
        if(Authentication::Authenticate($_COOKIE["token"])){
            header('Location: http://localhost:8000/dashboard');
            $bool = false;
        }
        
    }
    if($bool){
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            if(isset($_SERVER["error"]))
                echo "<p>Die E-Mail oder das Passwort ist nicht korrekt!</p>";
            if(isset($_SERVER["token_error"]))
                echo "<p>Der Token ist inkorrekt oder abgelaufen! Bitte logge dich erneut ein</p>";
        ?>
        
        <form action="http://localhost:8000/dashboard" method="POST">
            <input type="email" name="email"/>
            <br>
            <br>
            <input type="password" name="password"/>
            <input type="submit" name="submit"/>
        </form>
    </body>
</html>

<?php
    }
?>
