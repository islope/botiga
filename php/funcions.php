<?php
session_start();
function registro()
{
    require_once("connexio.php");
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

                $dades = file_get_contents($temp);
                $dades = mysqli_real_escape_string($connexio, $dades);

                $sql = "INSERT INTO usuari(email, password, nom, cognoms, direccio, poblacio, cPostal, dadesFoto, tipusFoto) 
                VALUES ('$email', '$pass', '$nom', '$cognoms', '$direccio', '$poblacio', '$codipost', '$dades', '$type')";

            
                if (mysqli_query($connexio, $sql) == true) {
                    echo "<br> Dades inserides correctament";
                } else {
                    echo "<br> Error les dades no s'han pogut incerir";
                }
            }
        }
    }
}

function login($email, $pass){
    require_once("connexio.php");

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
                $_SESSION["usuari"] = $fila["nom"];
                header("location: plana1.php");

            } 
            else {
                echo "error";
            }       
    
        }else {
            echo "EL usuari no existeix";
        }
    }


}

?>