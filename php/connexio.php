<?php

$servidor = "localhost"; // “127.0.0.1” o la IP o nom del domini
$usuari = "root"; // usuari de la bbdd
$clau = ""; // password
$bbdd = "botiga2022";

$connexio = mysqli_connect($servidor, $usuari, $clau, $bbdd);

/* if (!$connexio) {
    echo "error de connexio";
} else {
    echo "Connexio realizada <br>";
} */

?>