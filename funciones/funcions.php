<?php


if (isset($_POST["salir"])) {
    session_start();
    session_unset();
    session_destroy();
    header("location: /login.php");
}
function registro()
{
    require_once("../connexio/connexio.php");
    if (isset($_POST["registro"])) {

        if (strcmp($_POST["pass1"], $_POST["pass2"]) == 1) {
            echo "ERROR - Les contrasenyes no coincideixen";
        } else {

            if (isset($_FILES["foto"])) {

                $nom = $_POST["nom"];
                $cognoms = $_POST["cognoms"];
                $email = $_POST["email"];
                $pass = md5($_POST["pass1"]);
                $direccio = $_POST["direccio"];
                $poblacio = $_POST["poblacio"];
                $codipost = $_POST["codipost"];



                $temp = $_FILES['foto']['tmp_name'];
                $type = $_FILES['foto']['type'];

                if ($nom == "Admin") {

                    $dades = file_get_contents($temp);
                    $dades = mysqli_real_escape_string($connexio, $dades);

                    $sql = "INSERT INTO usuari(email, password, nom, cognoms, direccio, poblacio, cPostal, dadesFoto, tipusFoto, admin) 
                VALUES ('$email', '$pass', '$nom', '$cognoms', '$direccio', '$poblacio', '$codipost', '$dades', '$type', 1)";
                } else {
                    $dades = file_get_contents($temp);
                    $dades = mysqli_real_escape_string($connexio, $dades);

                    $sql = "INSERT INTO usuari(email, password, nom, cognoms, direccio, poblacio, cPostal, dadesFoto, tipusFoto) 
                VALUES ('$email', '$pass', '$nom', '$cognoms', '$direccio', '$poblacio', '$codipost', '$dades', '$type')";
                }



                if (mysqli_query($connexio, $sql) == true) {
                    echo "<br> Dades inserides correctament";
                } else {
                    echo "<br> Error les dades no s'han pogut incerir";
                }
            }
        }
    }
}
function login($email, $pass)
{
    require_once("../connexio/connexio.php");

    if (isset($_POST["login"])) {
        $existe = "SELECT COUNT(*) as cuenta FROM usuari WHERE email LIKE '$email'";
        $res = mysqli_query($connexio, $existe);
        $fila = mysqli_fetch_assoc($res);

        if ($fila["cuenta"] == 1) {
            $sql = "SELECT * FROM usuari WHERE email LIKE '$email'";
            $res = mysqli_query($connexio, $sql);
            $fila = mysqli_fetch_assoc($res);

            if (md5($pass) == $fila["password"]) {
                echo "Usuari correcte";
                $_SESSION["usuari"] = $_POST["emaillogin"];
                $_SESSION["aDatos"] = array();
                $_SESSION["total"] = 0;

                $admin = "SELECT * FROM usuari WHERE email LIKE '$email'";
                $res = mysqli_query($connexio, $admin);
                $fila = mysqli_fetch_assoc($res);

                if ($fila["admin"] == 1) {
                    header("location: ../php/admin.php");
                } else {
                    header("location: ../php/main.php");
                }
            } else {
                echo "La contrasenya és incorrecta";
            }
        } else {
            echo "EL usuari no existeix";
        }
    }
}

function usulog()
{
    require_once("../connexio/connexio.php");

    $sql = "SELECT * FROM usuari WHERE email LIKE '$_SESSION[usuari]'";
    $res = mysqli_query($connexio, $sql);
    $fila = mysqli_fetch_assoc($res);
    $foto = '<img class="img-responsive fotoperfil" src="data:' . $fila['tipusFoto'] . ';base64,' . base64_encode($fila['dadesFoto']) . ' ">';

?>
    <li class="usuari"><b>Benvingut <?php echo $fila["nom"] ?></b></li>
    <li> <?php echo $foto ?></li>
<?php
}

function comprafinal()
{
    $servidor = "localhost"; // “127.0.0.1” o la IP o nom del domini
    $usuari = "root"; // usuari de la bbdd
    $clau = ""; // password
    $bbdd = "botiga2022";

    $connexio = mysqli_connect($servidor, $usuari, $clau, $bbdd);

    if (isset($_POST["comprafinal"])) {

        if ($_SESSION["preutotal"] == 0) {
            echo "Has d'afegir articles a la cistella";

        } else {

            $sql = "INSERT INTO compra (data, email) VALUES (SYSDATE(), '$_SESSION[usuari]')";
            if (mysqli_query($connexio, $sql) == true) {
                echo "<br>Compra realitzada correctament";

                foreach ($_SESSION['aDatos'] as $key => $value) {
                    $cantidad = $value['stock'];
                    $id = $value['id'];
                    $sql = "UPDATE producte SET stock = stock - $cantidad WHERE codiProducte = $id";
                    mysqli_query($connexio, $sql);
                }

                $sqlcompra = "SELECT codiCompra FROM compra Order by codiCompra Desc";
                $rescompra = mysqli_query($connexio, $sqlcompra);
                $filacompra = mysqli_fetch_assoc($rescompra);



                foreach ($_SESSION['aDatos'] as $key => $value) {
                    $codicompra = $filacompra["codiCompra"];
                    $id = $value['id'];
                    $sql = "INSERT INTO comanda (codiCompra, codiProducte) VALUES ($codicompra, $id)";
                    mysqli_query($connexio, $sql);
                }


                session_destroy();
            } else {
                echo "<br>Error al comprar";
            }
        }
    }
}


function afegir()
{
    include("../connexio/connexio.php");

    if (isset($_POST["afegir"])) {
        if (isset($_FILES["foto"])) {
            $nom = $_POST["nom"];
            $desc = $_POST["desc"];
            $preu = $_POST["preu"];
            $stock = $_POST["stock"];

            $temp = $_FILES['foto']['tmp_name'];
            $type = $_FILES['foto']['type'];

            $dades = file_get_contents($temp);
            $dades = mysqli_real_escape_string($connexio, $dades);

            $insert = "INSERT INTO producte (nom, descripcio, preu, stock, dadesImatge, tipusImatge) VALUES ('$nom', '$desc', '$preu', '$stock', '$dades', '$type')";
            if (mysqli_query($connexio, $insert) == true) {
                echo "<br> Dades inserides correctament";
            } else {
                echo "<br> Error les dades no s'han pogut incerir";
            }
        }
    }
}


function modificar()
{
    include("../connexio/connexio.php");

    if (isset($_POST["modificar"])) {
        $codi = $_POST["id"];
        $nom = $_POST["nom"];
        $desc = $_POST["desc"];
        $preu = $_POST["preu"];
        $stock = $_POST["stock"];

        $temp = $_FILES['foto']['tmp_name'];
        $type = $_FILES['foto']['type'];

        $dades = file_get_contents($temp);
        $dades = mysqli_real_escape_string($connexio, $dades);

        $sql = "UPDATE producte SET nom = '$nom', descripcio = '$desc', preu = '$preu', stock = $stock, dadesImatge = '$dades', tipusImatge = '$type' WHERE codiProducte = $codi";

        if (mysqli_query($connexio, $sql) == true) {
            echo "<br> Dades Modificades correctament";
        } else {
            echo "<br> Error les dades no s'han pogut modificar";
        }
    }
}

function eliminar()
{
    include("../connexio/connexio.php");

    if (isset($_POST["eliminar"])) {
        $codi = $_POST["id"];

        $sql = "DELETE FROM producte WHERE codiProducte = '$codi'";

        if (mysqli_query($connexio, $sql) == true) {
            echo "<br> Dades eliminades correctament";
        } else {
            echo "<br> Error les dades no s'han pogut eliminar";
        }
    }
}
