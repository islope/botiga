<?php
include ("../php/funcions.php");
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/estilo.css">
    <title>Ismael López Pellicer</title>

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
    <div class="container contenedor">
        <div class="row">
            <div class="col-lg-5">
                <form action="" method="POST" role="form">
                    <legend>Login</legend>

                    <div class="form-group">
                        <label for="">Usuari</label>
                        <input class="form-control" type="email" name="emaillogin">
                        <label for="">Contrasenya</label>
                        <input class="form-control" type="password" name="passlog">
                    </div>
                    <button type="submit" name="login" class="btn btn-primary">Submit</button>
                </form>
                <?php
                login($_POST["emaillogin"] ?? false, $_POST["passlog"] ?? false);
                ?>

            </div>

            <div class="col-lg-5 col-lg-offset-2">
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
                        <input  type="file" name="foto">
                    </div>

                    <button name="registro" type="submit" class="btn btn-primary">Submit</button>
                </form>
                <?php
                registro();
                ?>
            </div>
        </div>
    </div>


    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Bootstrap JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>

</html>