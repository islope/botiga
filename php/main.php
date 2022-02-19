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
    <title>FLoristeria</title>

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
                    <li><a href="carrito.php" class="glyphicon glyphicon-shopping-cart">Carrito</a></li>
                    <li>
                        <form action="" method="post">
                            <button type="submit" name="salir" class="btn btn-default salir">LogOut</button>
                        </form>
                    </li>

                </ul>
            </div><!-- /.navbar-collapse -->
        </div>
    </nav>



    <div id="carousel-id" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carousel-id" data-slide-to="0" class=""></li>
            <li data-target="#carousel-id" data-slide-to="1" class=""></li>
            <li data-target="#carousel-id" data-slide-to="2" class="active"></li>
        </ol>
        <div class="carousel-inner">
            <div class="item">
                <img class="car" data-src="holder.js/900x500/auto/#777:#7a7a7a/text:First slide" alt="First slide" src="https://i0.wp.com/www.kukyflor.com/blog/wp-content/uploads/2018/04/tulip_fields_tulips_field_flower_flowers_2560x1440.jpg?ssl=1">
            </div>
            <div class="item">
                <img class="car" data-src="holder.js/900x500/auto/#666:#6a6a6a/text:Second slide" alt="Second slide" src="https://www.thoughtco.com/thmb/c_mf-JDqGaosMVPzmVZetVmd0A4=/1253x839/filters:fill(auto,1)/155873791-58b9d6555f9b58af5cab0436.jpg">
            </div>
            <div class="item active">
                <img class="car" data-src="holder.js/900x500/auto/#555:#5a5a5a/text:Third slide" alt="Third slide" src="https://www.floresbonitas.online/wp-content/uploads/2020/04/lirio-rosa-min-1.jpg">
            </div>
        </div>
        <a class="left carousel-control" href="#carousel-id" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
        <a class="right carousel-control" href="#carousel-id" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
    </div>

    <br><br><br>

    <div class="container">
        <div class="row flores">
            <?php

            include("../connexio/connexio.php");

            $sql = "SELECT * FROM producte";
            $res = mysqli_query($connexio, $sql);

            while ($fila = mysqli_fetch_assoc($res)) {

            ?>

                <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 text-center col-lg-offset-1">
                <?php
                echo '<img class="img-responsive" src="data:' . $fila['tipusImatge'] . ';base64,' . base64_encode($fila['dadesImatge']) . '">';
                
                ?>

                    <h4><b><?php echo $fila["nom"]; ?></b></h4>
                    <p>Preu: <?php echo $fila["preu"]; ?>€</p>

                    <?php
                    if ($fila["stock"] != 0) {
                        ?>
                        <form action="./carrito.php" method="post">
                            <input type="hidden" name="codi" value="<?php echo $fila["codiProducte"]; ?>">
                            <input type="hidden" name="nom" value="<?php echo $fila["nom"]; ?>">
                            <input type="hidden" name="desc" value="<?php echo $fila["descripcio"]; ?>">
                            <input type="hidden" name="preu" value="<?php echo $fila["preu"]; ?>">
                            <input type="hidden" name="stock" value="1">
                            <input type="hidden" name="foto" value="<?php echo "data:" . $fila['tipusImatge'] . ";base64," . base64_encode($fila['dadesImatge']);?>">
                            <button type="submit" name="compra" class="btn btn-default">Comprar</button>
                        </form>
                        <br>
                        <?php
                    }
                    if ($fila["stock"] > 0 and $fila["stock"] <= 5) {
                        ?>
                        
                        <div class="alert">
                            <strong>Queden poques unitats</strong>
                        </div>
                        
                        <?php
                    }
                    if ($fila["stock"] == 0) {
                        ?>
                            <h4>No hi ha stock</h4>
                        <?php
                    }
                    ?>

                </div>
            <?php
            }

            ?>
        </div>

    </div>


    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Bootstrap JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>

</html>