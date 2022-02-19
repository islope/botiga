<?php
include ("../funciones/funcions.php");

?>

<!DOCTYPE html>
<html lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registre</title>

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
        <form action="" method="POST" role="form" enctype="multipart/form-data">
            <legend>Registre</legend>

            <div class="form-group">
                <label for="">Nom</label>
                <input class="form-control" type="text" name="nom" required>
                <label for="">Cognoms</label>
                <input class="form-control" type="text" name="cognoms" required>
                <label for="">Email</label>
                <input class="form-control" type="email" name="email" required>
                <label for="">Password</label>
                <input class="form-control" type="password" name="pass1" required>
                <label for="">Rpeteix el Password</label>
                <input class="form-control" type="password" name="pass2" required>
                <label for="">Direcció</label>
                <input class="form-control" type="text" name="direccio" required>
                <label for="">Població</label>
                <input class="form-control" type="text" name="poblacio" required>
                <label for="">CPostal</label>
                <input class="form-control" type="text" name="codipost" required>
                <label for="">Foto</label>
                <input type="file" name="foto">
            </div>

            <button name="registro" type="submit" class="btn btn-primary">Regisre</button>
            <span>o</span>
            <a class="btn btn-primary" href="./login.php">Login</a>

        </form>
        <?php
        if (isset($_POST["login"])) {
            header("Location: login.php");
        }
        registro();
        ?>
    </div>

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Bootstrap JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>

</html>