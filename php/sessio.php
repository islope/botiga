<?php
session_start();
login($email, $pass);

$_SESSION["usuari"] = $_POST["usuari"];
$_SESSION["password"] = md5($_POST["password"]);


if ($_SESSION["usuari"] === "client" && $_SESSION["password"] === '344309ef4bfdca9515ebef72c1f3788a') {
    header('Location: '."Cliente/clients.php");
}
else if ($_SESSION["usuari"] === "admn"  && $_SESSION["password"] === '344309ef4bfdca9515ebef72c1f3788a') {
    header('Location: '."Admin/admin.php");
}

else {
    
?>    <h2>Error - Usuario o contraseña incorrectos</h2>

    <form action="sessio.php" method="post">
        <label for="">Usuari</label>
        <br>
        <input type="text" name="usuari">
        <br>
        <label for="">Contrasenya</label>
        <br>
        <input type="password" name="password">
        <input type="submit" value="enviar" name="enviar">
    </form>
<?php
}
?>