<?php
require_once('./clases/ClaseUsuario.php');
$logout = "";
if (!isset($_SESSION['usuario']) || !$_SESSION['usuario'] instanceof Usuario) {
    $logout = "log-out.png";
} else {
    $logout = $_SESSION['usuario']->getPic();
}
?>
<header>
    <h1>Wazzap</h1>
    <a href="crearCuenta.php"><img src="./style/img/<?= $logout ?>" alt="usuario desconectado" width="50px"></a>
</header>