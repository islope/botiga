<?php
session_start();

require_once("../funciones/funcions.php");

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
    <title>Carrito</title>

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
                <a class="navbar-brand" href="./main.php">Floristeria RL</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">

                <ul class="nav navbar-nav navbar-right">
                    <?php usulog() ?>
                    <li><a href="./main.php">Productos</a></li>
                    <li>
                        <form action="" method="post">
                            <button type="submit" name="salir" class="btn btn-default salir">LogOut</button>
                        </form>
                    </li>

                </ul>
            </div><!-- /.navbar-collapse -->
        </div>
    </nav>


    <h1 class="text-center">Carrito</h1>

    <?php


    if (isset($_POST["compra"])) {
        $esta = false;

        foreach ($_SESSION["aDatos"] as $key => $value) {
            if ($value["id"] == $_POST["codi"]) {
                $esta = true;
                $pos = $key;
            }
        }

        if ($esta == true) {
            $_SESSION["aDatos"][$pos]["stock"] += $_POST["stock"];
            $_SESSION["aDatos"][$pos]["preu"] += $_POST["preu"];
        } else {
            if (isset($_SESSION["aDatos"])) {
                array_push($_SESSION["aDatos"], array(
                    "Nom" => $_POST["nom"],
                    "id" => $_POST["codi"],
                    "desc" => $_POST["desc"],
                    "foto" => "<img style='width: 150px;' src='" . $_POST['foto'] . "'>",
                    "preu" => $_POST["preu"],
                    "stock" => $_POST["stock"]

                ));
            } else {
                $_SESSION["aDatos"] = array();
                array_push($_SESSION["aDatos"], array(
                    "Nom" => $_POST["nom"],
                    "id" => $_POST["codi"],
                    "desc" => $_POST["desc"],
                    "foto" => "<img style='width: 150px;' src='" . $_POST['foto'] . "'>",
                    "preu" => $_POST["preu"],
                    "stock" => $_POST["stock"]

                ));
            }
        }
    }


    ?>


    <div class="container">
        <table class="table table-hover">


            <thead>
                <tr>
                    <th>Foto</th>
                    <th>Nom</th>
                    <th>Preu</th>
                    <th>Descripcio</th>
                    <th>Quantitat</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total = 0;
                foreach ($_SESSION['aDatos'] as $key => $value) {
                    echo "<tr>";
                    echo "<td>" . $value['foto'] . "</td>";
                    echo "<td>" . $value['Nom'] . "</td>";
                    echo "<td>" . $value['preu'] . "€</td>";
                    echo "<td>" . $value['desc'] . "</td>";
                    echo "<td class='text-center'>" . $value['stock'] . "</td>";
                    echo "</tr>";
                    $total = $total + $value['preu'];
                    $_SESSION["cantidad"] =  $value['stock'];
                    $_SESSION["id"] = $value['id'];
                }
                $_SESSION["preutotal"] = $total;
                ?>
            </tbody>

        </table>
        <p>Total: <?php echo $_SESSION["preutotal"] ?>€</p>

        <form action="" method="POST" role="form">
            <button type="submit" name="comprafinal" class="btn btn-primary">Comprar</button>
            <br><br>
        </form>
        <?php
        comprafinal();
        ?>
    </div>


    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Bootstrap JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>

</html>