<?php
session_start();

require("../funciones/funcions.php");

if ($_SESSION["usuari"] == "") {
    header("location: login.php");
}


?>
<!DOCTYPE html>
<html lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/c.css">
    <title>Adminisracio</title>

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
    <nav class="navbar navbar-default" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Floristeria RL</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">

                <ul class="nav navbar-nav navbar-right">
                    <?php usulog() ?>
                    <li>
                        <form action="" method="post">
                            <button type="submit" name="salir" class="btn btn-default salir">LogOut</button>
                        </form>
                    </li>

                </ul>
            </div><!-- /.navbar-collapse -->
        </div>
    </nav>


    <br><br>
    <div class="container">
        <form action="" method="POST" role="form" enctype="multipart/form-data">
            <legend>Afegir profucte</legend>

            <div class="form-group">
                <label for="">Nom del producte</label>
                <input type="text" name="nom" class="form-control" required>
                <label for="">Descripcio</label>
                <textarea name="desc" id="input" class="form-control" rows="3" required="required"></textarea>
                <label for="">Preu</label>
                <input type="number" name="preu" class="form-control" required>
                <label for="">Stock</label>
                <input type="number" name="stock" class="form-control" required>
                <label for="">Imatge del producte</label>
                <input type="file" name="foto">
            </div>

            <button type="submit" name="afegir" class="btn btn-primary">Afegir</button>
        </form>
        <?php afegir() ?>
    </div>

    <br><br>
    <div class="container">
        <form action="" method="POST" role="form" enctype="multipart/form-data">
            <legend>Modificar profucte</legend>

            <?php
            include("../connexio/connexio.php");
            $sql = "SELECT * FROM producte";
            $res = mysqli_query($connexio, $sql);


            ?>
            <div class="form-group">

                <select name="id" id="input" class="form-control" required="required">
                    <option value="" selected disabled>Tria un producte</option>
                    <?php
                    while ($fila = mysqli_fetch_assoc($res)) {
                    ?>
                        <option value="<?php echo $fila["codiProducte"] ?>"><?php echo $fila["nom"] ?></option>
                    <?php
                    }

                    ?>

                </select>

                <label for="">Nom del producte</label>
                <input type="text" name="nom" class="form-control" required>
                <label for="">Descripcio</label>
                <textarea name="desc" id="input" class="form-control" rows="3" required></textarea>
                <label for="">Preu</label>
                <input type="number" name="preu" class="form-control" required>
                <label for="">Stock</label>
                <input type="number" name="stock" class="form-control" required>
                <label for="">Imatge del producte</label>
                <input type="file" name="foto" required>
            </div>
            <button type="submit" name="modificar" class="btn btn-primary">Modificar</button>
        </form>
        <?php modificar() ?>
    </div>

    <br><br>
    <div class="container">

        <form action="" method="POST" role="form">
            <legend>Eliminar</legend>

            <?php
            include("../connexio/connexio.php");
            $sql = "SELECT * FROM producte";
            $res = mysqli_query($connexio, $sql);


            ?>

            <div class="form-group">
                <select name="id" id="input" class="form-control" required="required">
                    <option value="" selected disabled>Tria un producte</option>
                    <?php
                    while ($fila = mysqli_fetch_assoc($res)) {
                    ?>
                        <option value="<?php echo $fila["codiProducte"] ?>"><?php echo $fila["nom"] ?></option>
                    <?php
                    }

                    ?>
                </select>
            </div>
            <button type="submit" name="eliminar" class="btn btn-primary">Eliminar</button>
        </form>
        <?php eliminar() ?>

    </div>




    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Bootstrap JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>

</html>