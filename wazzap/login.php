<?php
/* Login.php */
/* PHP 2 Necesitaremos usar sesion para mantener el usuario*/
session_start();
/* PHP 2.1 Necesitaremos usar las funciones relacionadas con el usuario asi que usamos el require once y la clase User */
require_once('./clases/ClaseUsuario.php');
require_once('./funciones/funcionesUsuario.php');
?>
<!-- HTML 1 Creamos la pagina de loggin -->
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/style.css">
    <title>Login</title>
</head>

<body>
    <!-- HTML  1.2 Creamos una imagen dinamica para crear la cuenta en el header y hemos usado include para llamar a todo el header.php -->
    <?php include("./includes/header.php"); ?>
    <main>
        <div>
            <!-- HTML  1.3 Creamos un formulario para ingresar nuestra cuenta si es que ya tenemos una. Usamos el metodo post y lo mandamos a nuestra misma pantalla de login -->
            <form method="post" action="?">
                <label for="telefono">Telefono:</label>
                <input type="tel" name="telefono" id="telefono" minlength="9" maxlength="9">
                <label for="pass">Contraseña:</label>
                <input type="password" name="pass" id="pass">
                <input type="submit" value="Entrar">
            </form>
            <!-- HTML  1.4 Creamos boton para crear cuenta si no tenemos -->
            <p>No tienes cuenta? Registrate :) </p>
            <a href="crearCuenta.php"><button>Crear Cuenta</button></a>

        </div>
        <?php
        /* PHP 2.2 Como queremos rescatar los datos del formulario  usamos el método POST */
        /* PHP 2.2.1 preguntamos si el usuario ha enviado el formulario  por metodo post y si es asi almacenamos las variables*/
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $phone = $_POST['telefono'];
            $pass = $_POST['pass'];
            /* PHP 2.3 necesitaremos una funcion que nos diga si el usuario existe y si la contraseña es correcta y le pasamos los datos del usuario */
            $usuarioExiste = meterUsuarioEnSesion($phone, $pass);
            /* PHP 2.3.1 Creamos un condicional para saber si el usuario existe y si es así nos manda a index.php*/
            if ($usuarioExiste) {
                /* PHP 2.4 si el usuario existe y la contraseña es correcta entonces creamos una session usuario en la que metemos un objeto usuario*/
                $_SESSION['usuario'] = $usuarioExiste;
                /* PHP 2.5 redireccionamos al usuario a la pagina principal */
                header('Location: index.php');
            } else {
                echo "<p style='color: red; font-size:20px;'>El usuario no existe o la contraseña es incorrecta</p>";
            }
        }
        ?>
    </main>
    <!-- HTML 1.5 llamamos a metodo include para que se cargue el footer-->
    <?php include('./includes/footer.php'); ?>

</body>

</html>