<?php
require_once('./clases/ClaseContacto.php');

?>
<header>
    <img src="./style/img/<?= $_SESSION['contacto']->getPic()  ?>" alt="usuario desconectado" width="50px"></a>
    <h1><?= $_SESSION['contacto']->getName()." ". $_SESSION['contacto']->getSurname() ?> </h1>
    <h3><?= $_SESSION['contacto']->getPhone() ?></h3>
</header>