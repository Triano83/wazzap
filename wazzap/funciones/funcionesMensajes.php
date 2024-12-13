<!-- Funciones Mensajes -->
<?php
require_once('./funciones/funcionesContactos.php');
require_once('./clases/ClaseUsuario.php');
require_once('./clases/ClaseContacto.php');
require_once('conexion.php');

/* PHP  Creamos un Objeto usuario para meterlo en la sesion */
function meterContactoEnSesion($id)
{
    /*  PHP  abrimos conexion*/
    $conexion = conectarBD();
    /* PHP  Usamos la sentencia sql para obtener los datos del usuario */
    $sql = "SELECT * FROM contactos WHERE id = ?";
    /* PHP  Preparamos la sentencia sql */
    $sqlPrepare = $conexion->prepare($sql);
    /* PHP  Luego usamos bind param para insentarle los valores en las ?*/
    $sqlPrepare->bind_param("i", $id);
    /* PHP  Luego ejecutamos la sentencia sql */
    $sqlExecute = $sqlPrepare->execute();
    /* PHP  Obtenemos todos los datos de usuarios que coincidan con nuestras query con get Result */
    $sqlResult = $sqlPrepare->get_result();
    /* PHP  Con esta comprobacion verificamos si hay exastamente 1 dato */
    if ($sqlResult->num_rows == 1) {
        /* PHP  obtenemos el resultado de la query de la primera linea de datos con fetch_assoc 
        (recordad que fetch_assoc() devuelve un array asociativo y lo va recorriendo) */
        $contactoBD = $sqlResult->fetch_assoc();
        /* PHP  Creamos el objeto Usuario gracias a los datos almacenados en contactoBD
         (para sacar los datos de este array asociativo que hemos creado con fetch_assoc() usamos la estructura siguiente array['nombre'], array['edad'], etc) */
        $contacto = new Contacto(
            $contactoBD['id'],
            $contactoBD['name'],
            $contactoBD['surname'],
            $contactoBD['phone'],
            $contactoBD['pic'],
            $contactoBD['id_user']
        );
        /* PHP  Cerramos la conexion */
        $conexion->close();
        /* PHP  retornamos el objeto usuario */
        return $contacto;
    }
    /* PHP cerramos conexion*/
    $conexion->close();
    /* PHP si el resultado de la query no es 1, es decir, no hay usuario con ese telefono y contraseña devuelve false */
    return false;
}

function crearMensaje($text, $id_contacto)
{

    $conexion = conectarBD();
    $fecha = date('Y-m-d H:i:s');
    $sql = "INSERT INTO mesage (text, date ,contac_id) VALUES (?,?,?)";
    $sqlPrepare = $conexion->prepare($sql);
    $sqlPrepare->bind_param("ssi", $text, $fecha, $id_contacto);
    $sqlExecute = $sqlPrepare->execute();
    $conexion->close();
    return $sqlExecute;
}

function obtenerMensajes($id_contacto)
{

    $conexion = conectarBD();
    $sql = "SELECT * FROM mesage WHERE contac_id = ?";
    $sqlPrepare = $conexion->prepare($sql);
    $sqlPrepare->bind_param("i", $id_contacto);
    $sqlExecute = $sqlPrepare->execute();
    $sqlResult = $sqlPrepare->get_result();
    $mensajes = [];
    while ($row = $sqlResult->fetch_assoc()) {
        $mensajes[] = new Mensaje(
            $row['id'],
            $row['text'],
            $row['date'],
            $row['contac_id']
        );
    }
    $conexion->close();
    return $mensajes;
}
