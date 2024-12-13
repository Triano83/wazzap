<!-- Funciones contactos -->
<?php
require_once('./clases/ClaseUsuario.php');
require_once('./clases/ClaseContacto.php');
require_once('conexion.php');

function crearContacto($name, $surname, $phone, $pic, $idUsuario)
{
    /* PHP 10.0 Abrimos conexion */
    $conexion = conectarBD();
    /* PHP 10.1 Preparamos la imagen para que se guarde correctamente en la base de datos y nuestro pc */
    $namePic = $pic['name'];
    $tmpPic = $pic['tmp_name'];
    $savePic = move_uploaded_file($tmpPic, './style/img/' . $namePic);
    /* PHP 10.2 Hacemos la sentencia SQL */
    $sql = "INSERT INTO contactos (name,surname,phone,pic,id_user) VALUES (?,?,?,?,?)";
    /* PHP 10.3 Preparamos la sentencia SQL */
    $sqlPrepare = $conexion->prepare($sql);
    /* PHP 10.4 Agregamos los datos con bind param a la sentencia */
    $sqlPrepare->bind_param("ssisi", $name, $surname, $phone, $namePic, $idUsuario);
    /* PHP 10.5 Ejecutamos la sentencia sql */
    $sqlExecute = $sqlPrepare->execute();
    /* PHP 10.6 Cerramos conexion */
    $conexion->close();
    /* PHP 10.7 Retornamos el resultado true en caso de que todo salga bien, false en lo contrario*/
    return $sqlExecute;
}

/* PHP 10.8 Esta funcion nos sirve para obtener un array de contactos */
function obtenerContactos($busqueda, $id_user)
{
    /* PHP 10.9 Abrimos conexión */
    $conexion = conectarBD();

    if (!empty($busqueda)) {
        /* PHP 10.10 Hacemos la sentencia SQL */
        $sql = "SELECT * FROM contactos WHERE (name LIKE ? OR surname LIKE ? OR phone LIKE ?) AND id_user = ?";

        /* PHP 10.11 Preparamos la sentencia SQL */
        $sqlPrepare = $conexion->prepare($sql);

        /* PHP 10.12 Modificamos la búsqueda para incluir los comodines % */
        $busqueda = "%$busqueda%";

        /* PHP 10.13 Agregamos los datos con bind param a la sentencia */
        $sqlPrepare->bind_param("sssi", $busqueda, $busqueda, $busqueda, $id_user);
    } else {
        /* PHP 10.14 Hacemos la sentencia SQL */
        $sql = "SELECT * FROM contactos WHERE id_user = ?";

        /* PHP 10.15 Preparamos la sentencia SQL */
        $sqlPrepare = $conexion->prepare($sql);

        /* PHP 10.16 Agregamos los datos con bind param a la sentencia */
        $sqlPrepare->bind_param("i", $id_user);
    }

    /* PHP 10.17 Ejecutamos la sentencia SQL */
    $sqlPrepare->execute();

    /* PHP 10.18 Le pedimos a la BD que nos muestre los datos y los almacenamos */
    $resultadoQuery = $sqlPrepare->get_result();

    /* PHP 10.19 Creamos un while que nos servirá para recorrer todos los datos que nos devuelve la BD 
    y a su vez ir creando objetos Contacto y almacenarlos en un array */
    $contactos = [];
    while ($datos = $resultadoQuery->fetch_assoc()) {
        $contactos[] = new Contacto(
            $datos['id'],
            $datos['name'],
            $datos['surname'],
            $datos['phone'],
            $datos['pic'],
            $datos['id_user']
        );
    }

    /* PHP 10.20 Cerramos la conexión */
    $conexion->close();

    /* PHP 10.21 Retornamos el array de contactos */
    return $contactos;
}
