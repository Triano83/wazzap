<?php
require_once('./funciones/funcionesUsuario.php');
?>
<!-- CREAR CUENTA .PHP -->
<!-- HTML 6.2  Creamos el formulario en HTML acordarse de poner enctype = multipart.. para poder almacenar archivos -->
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/style.css">
    <title>Crear Cuenta</title>
</head>

<body>
    <?php include('./includes/header.php'); ?>
    <main>
        <form action="" method="post" enctype="multipart/form-data">
            <label for="phone">Teléfono:</label>
            <input type="tel" id="phone" name="phone" required>

            <label for="pass">Contraseña:</label>
            <input type="password" id="pass" name="pass" required>

            <label for="pic">Avatar:</label>
            <input type="file" id="pic" name="pic" accept="image/*" required>

            <input type="submit" value="Enviar">
        </form>
        <?php
        /* PHP 6 como vamos hacer un formulario por post tenemos que preguntar si la web recargó con ese metodo
y si es así almacenamos los datos en variables para poder usarlos*/
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $phone = $_POST['phone'];
            $pass = $_POST['pass'];
            $pic = $_FILES['pic'];
            /* PHP 6.1 llamamos a la funcion crear usuario  para  que nos diga si se ha podido crear el usuario o no*/
            $crearUsuario = crearUsuario($phone, $pass, $pic);
            if ($crearUsuario) {
                header('Location:login.php');
            } else {
                echo "Error al crear el usuario";
            }
        }
        ?>
    </main>
    <?php include('./includes/footer.php'); ?>

</body>

</html>