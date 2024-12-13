<!-- Index -->
<?php
/* PHP 8 iniciamos sesion y usamos los requires once que necesitemos */
require_once('./funciones/funcionesContactos.php');
require_once('./clases/ClaseUsuario.php');
require_once('./clases/ClaseContacto.php');
require_once('./funciones/conexion.php');

session_start();


// PHP 8.1 Verificar si el usuario está logueado 
if (!isset($_SESSION['usuario'])) {
    // PHP 8.2 Si no está logueado, redirigir al login
    header('Location: login.php');
    exit();
}


/* PHP 8.3 si la web es cargada usando metodo post almacenamos en variables los datos 
necesarios para poder crear un contacto y si el contacto ha sido creado con exito se recarga la web de lo 
contrario nos lanza un mensaje de error */
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $phone = $_POST['phone'];
    $pic = $_FILES['pic'];
    $idUsuario = $_SESSION['usuario']->getId();
    $crearContacto = crearContacto($name, $surname, $phone, $pic, $idUsuario);
    if ($crearContacto) {
        header('Location: index.php');
    } else {
        echo 'Error al crear contacto';
    }
    /* PHP 8.4 si por el contrario la web se ha recargado por otro metodo (get) almacenamos los datos que queremos buscar */
}else {
    $busqueda = isset($_GET['buscar']) ? $_GET['buscar'] : "";
    /* PHP 8.4.1 llamamos a la funcion obtenerContacto y le ofrecemos los datos que buscamos y la id del usuario 
    para que filtre la busqueda en la BD */
    $obtenerContactos = obtenerContactos($busqueda, $_SESSION['usuario']->getId());
}
/* PHP 8.5 para poder escribir js en PHP almacenamos como cadena de texto el codigo js para luego usarlo */
/* PHP 8.5.1 En este caso hemos creado una funcion onclick para que al pulsar se despliegue un dialog */
$funcionOnClick = "document.getElementById('agregarContacto').showModal()";
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/style.css">
    <title>Contactos</title>
</head>

<body>
    <?php include('./includes/header.php'); ?>
    <main class="main-index">
        <div>
            <!-- HTML 8.6 Creamos un formulario method get para filtrar los datos de la BD -->
            <form action="?" method="get" id="form-buscar">
                <label for="buscar">Buscar:</label>
                <input type="text" name="buscar">
                <input type="submit" value="Buscar">
            </form>
            <!-- HTML 8.7 inyectando PHP en el htlm hacemos que se ejecute un codigo de js -->
            <button onclick="<?= $funcionOnClick ?>">Crear Contacto</button>
        </div>
        <div class="contactos">
            <!-- PHP Y HTML 8.8 mostramos los contactos especificos que hemos buscados con la funcion ObtenerContactos
             y con el foreach los mostramos uno a uno -->
            <?php foreach ($obtenerContactos as $contacto): ?>
                <a href="mensajes.php?idContacto=<?= $contacto->getId() ?>">
                    <div class="container">
                        <img src="./style/img/<?= $contacto->getPic() ?>" alt="avatar" width="50px">
                        <p><?= $contacto->getName() ?></p>
                        <p><?= $contacto->getSurname() ?></p>
                        <p><?= $contacto->getPhone() ?></p>


                    </div>
                </a>

            <?php endforeach; ?>


        </div>
<!-- HTML 8.9 Creamos el formulario para crear un contacto mandando los datos por POST y este formulario solo se abre 
 al pulsar el boton crear contacto puesto que es un dialog -->
        <dialog id='agregarContacto'>
            <h2>Agregar Contacto</h2>
            <form action="index.php" method="post" enctype="multipart/form-data">
                <label for="name">Nombre:</label>
                <input type="text" name="name" id="name">
                <label for="surname">Apellidos:</label>
                <input type="text" name="surname" id="surname">
                <label for="phone">Telefono:</label>
                <input type="tel" name="phone" id="phone" minlength="9" maxlength="9">
                <input type="file" name="pic" id="pic">
                <input type="hidden" name="usuario" value="<?= $_SESSION['usuario']->getId() ?>">
                <input type="submit" value="Crear Contacto">
            </form>
        </dialog>

    </main>
    <?php include('./includes/footer.php'); ?>
</body>

</html>