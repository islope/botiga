<?php
session_start();
include("../funciones/funcions.php");


?>


<!DOCTYPE html>
<html lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>login</title>

    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.3/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
</head>

<body>
    <div class="container">
        <form action="" method="POST" role="form">
            <legend>Login</legend>

            <div class="form-group">
                <label for="">Usuari</label>
                <input class="form-control" type="email" name="emaillogin" required>
                <label for="">Contrasenya</label>
                <input class="form-control" type="password" name="passlog" req>
            </div>
            <button type="submit" name="login" class="btn btn-primary">Login</button>
            <span>o</span>
            <a class="btn btn-primary" href="./registro.php">Registre</a>
            <br><br>
        </form>
        <?php

        login($_POST["emaillogin"] ?? false, $_POST["passlog"] ?? false);
        ?>

    </div>

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Bootstrap JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>

</html>