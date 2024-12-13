<!-- MENSAJES -->
<?php
require_once('./clases/ClaseMensaje.php');
require_once('./clases/ClaseUsuario.php');
require_once('./clases/ClaseContacto.php');
require_once('./funciones/funcionesMensajes.php');
session_start();

// PHP 9 Verificar si el usuario está logueado 
if (!isset($_SESSION['usuario'])) {
    // PHP 9.1 Si no está logueado, redirigir al login
    header('Location: login.php');
    exit();
}
// PHP 9.2 Comprobar si el formulario se ha enviado mediante POST y si es así almacenar los datos
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $text = $_POST['text'];
    $id_contacto = $_POST['hidden'];
    $crearMensaje = crearMensaje($text, $id_contacto);
    // PHP 9.2.1 Si el mensaje se crea correctamente, redirigir a la página de mensajes del contacto
    if ($crearMensaje) {
        header("Location: mensajes.php?idContacto=" . $id_contacto);
        exit();
    } else {
        // PHP 9.2.2 Si hay un error al crear el mensaje
        echo 'Error al mandar el mensaje';
    }
    // PHP 9.3 Si la página se carga mediante GET, obtener el id del contacto y almacenarlo en la sesión
} else {

    $id_contacto = isset($_GET['idContacto']) ? $_GET['idContacto'] : "";
    $_SESSION['contacto'] = meterContactoEnSesion($id_contacto);
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/style.css">
    <title>Mensajes</title>
</head>

<body>
    <?= include('./includes/headerMensajes.php') ?>
    <main class="main-mensajes">
        <div class="mensajes">
            <!-- HTML 9.5 Formulario para enviar un nuevo mensaje -->
            <form action="?" method="post" class="formMensaje">
                <label for="text">Mensaje:</label>
                <textarea id="mensaje" name="text"></textarea>
                <br />
                <!-- HTML 9.6 Campo oculto para almacenar el id del contacto -->
                <input type="hidden" name="hidden" value="<?= $id_contacto ?>">
                
                <input type="submit" value="Enviar">
            </form>
        </div>
        <?php
        // PHP 9.7 Obtener los mensajes del contacto desde la base de datos
        $mensajes = obtenerMensajes($id_contacto);
        // PHP 9.8 Creamos los mensajes con la fecha y el texto
        foreach ($mensajes as $mensaje): ?>
            <div class="container">
                <div class="mensaje-block">
                    <p><?= $mensaje->getDate(); ?></p>
                    <p><?= $mensaje->getText(); ?></p>
                </div>

            </div>
        <?php endforeach; ?>
    </main>
    <?= include('./includes/footer.php') ?>
</body>

</html>