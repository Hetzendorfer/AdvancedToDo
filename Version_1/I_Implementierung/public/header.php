<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="http://localhost:8000/public/css/bootstrap.min.css">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
        <style>
            body{
                background-color: rgba(0, 0, 0, .01);
                margin-top: 50px;
            }
            .navbar{
                height: 50px;
                background-color: #719FAA;
            }
            .navbar a{
                color: white !important;
            }
            .signout:hover{
                color: rgba(0, 0, 0, .8) !important;
            }
            .sidebar{
                position: fixed;
                top: 0;
                bottom: 0;
                left: 0;
                z-index: 100;
                padding: 80px 0 0;
                box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1); 
            }
            main{
                padding-top: 50px;
                padding-right: 60px !important;
                padding-left: 60px !important;
            }
            .table-important{
                background-color: #FD9E9E;
            }
            .table-important:hover{
                cursor: default;
            }
            
            .login-form{
                border-radius: 3px;
                margin: auto;
                background-color: rgba(0,0,0,.0);
                width: 400px;
                box-shadow: 0 0.25rem 0.75rem rgba(0, 0, 0, .07);
                border: 1px solid rgba(0,0,0,.125);;
            }
            .submit{
                background-color: #719FAA;
                color: white;
            }
            .login-bar{
                background-color: #719FAA;
                height: 55px;
                width: 100%;
                color: white;
                font-size: 2em;
                text-align: center;
            }
            .login-content{
                border-top: 1px solid rgba(0,0,0,.125);;
                padding: 40px;
            }
            .datetime-input{
                width: 80px !important;
            }
            .addForm{
                margin-bottom: 20px;
            }
        </style>
    </head>
