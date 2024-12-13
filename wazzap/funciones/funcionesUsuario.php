<?php
/* FUNCIONES USUARIO.PHP */
/* Recordar hacer los requires necesarion */
require_once('conexion.php');
require_once('./clases/ClaseUsuario.php');

/* PHP 3 Creamos un Objeto usuario para meterlo en la sesion */
function meterUsuarioEnSesion($phone, $pass)
{
    /*  PHP 3.1 abrimos conexion*/
    $conexion = conectarBD();
    /* PHP 3.2 Usamos la sentencia sql para obtener los datos del usuario */
    $sql = "SELECT * FROM usuarios WHERE phone = ? AND pass = ?";
    /* PHP 3.3 Preparamos la sentencia sql */
    $sqlPrepare = $conexion->prepare($sql);
    /* PHP 3.4 Luego usamos bind param para insentarle los valores en las ?*/
    $sqlPrepare->bind_param("is", $phone, $pass);
    /* PHP 3.5 Luego ejecutamos la sentencia sql */
    $sqlExecute = $sqlPrepare->execute();
    /* PHP 3.6 Obtenemos todos los datos de usuarios que coincidan con nuestras query con get Result */
    $sqlResult = $sqlPrepare->get_result();
    /* PHP 3.7 Con esta comprobacion verificamos si hay exastamente 1 dato */
    if ($sqlResult->num_rows == 1) {
        /* PHP 3.8 obtenemos el resultado de la query de la primera linea de datos con fetch_assoc 
        (recordad que fetch_assoc() devuelve un array asociativo y lo va recorriendo) */
        $usuarioBD = $sqlResult->fetch_assoc();
        /* PHP 3.9 Creamos el objeto Usuario gracias a los datos almacenados en UsuarioBD
         (para sacar los datos de este array asociativo que hemos creado con fetch_assoc() usamos la estructura siguiente array['nombre'], array['edad'], etc) */
        $usuario = new Usuario(
            $usuarioBD['id'],
            $usuarioBD['phone'],
            $usuarioBD['pass'],
            $usuarioBD['pic']
        );
        /* PHP 3.10 Cerramos la conexion */
        $conexion->close();
        /* PHP 3.11 retornamos el objeto usuario */
        return $usuario;
    }
    /* 3.12 cerramos conexion*/
    $conexion->close();
    /* 3.13 si el resultado de la query no es 1, es decir, no hay usuario con ese telefono y contraseña devuelve false */
    return false;
}

/* PHP 7 Creamos un usuario para meterlo en la BD */
function crearUsuario($phone, $pass, $pic)
{
    /*  PHP 7.1 Primero tenemos que coprobar si ya hay un usuario creado con ese telefono */
    /* PHP 7.2 Abrimos la conexion */
    $conexion = conectarBD();
    /* PHP 7.3 Usamos la sentencia sql para obtener los datos del usuario */
    $sql = "SELECT * FROM usuarios WHERE phone = ?";
    /* PHP 7.4 Preparamos la sentencia sql */
    $sqlPrepare = $conexion->prepare($sql);
    /* PHP 7.5 Luego usamos bind param para insentarle los valores en las ?*/
    $sqlPrepare->bind_param("i", $phone,);
    /* PHP 7.6 Luego ejecutamos la sentencia sql */
    $sqlExecute = $sqlPrepare->execute();
    /* PHP 7.7 Obtenemos todos los datos de usuarios que coincidan con nuestras query con get Result */
    $sqlResult = $sqlPrepare->get_result();
    /* PHP 7.8 Con esta comprobacion verificamos si hay exastamente 1 dato */
    if ($sqlResult->num_rows == 1) {
        $conexion->close();
        echo "Ya existe un usuario con ese telefono <br>";
        return false;
    }

    /* PHP 7.9 Aunque tenemos la variable pic tenemos que rescatar el nombre de la imagen y el archivo donde esta 
    guardado temporalmente para luego mandarlo a la carpeta que nosotros queremos*/
    $nombreImagen = $pic['name'];
    $rutaImagen = $pic['tmp_name'];
    $seHaGuardado = move_uploaded_file($rutaImagen, './style/img/' . $nombreImagen);
    /* PHP 7.10 Si se ha guardado correctamente la imagen , creamos el usuario */
    if ($seHaGuardado) {
        /* PHP 7.11 Abrimos la conexion */

        /* PHP 7.12 Usamos la sentencia sql para insertar el usuario */
        $sql = "INSERT INTO usuarios (phone, pass, pic) VALUES (?, ?, ?)";
        /* PHP 7.13 Preparamos la sentencia sql */
        $sqlPrepare = $conexion->prepare($sql);
        /* 7.14 usamos bind param para insertar los valores en las ? */
        $sqlPrepare->bind_param("iss", $phone, $pass, $nombreImagen);
        /* PHP 7.15 ejecutamos la sentencia*/
        $sqlExecute = $sqlPrepare->execute();
        /* PHP 7.16 cerramos la conexion */
        $conexion->close();
        /* PHP 7.17 retornamos true o false dependiendo de si ha ido bien*/
        return $sqlExecute;
    } else {
        echo 'Algo ha ido mal con la imagen';
        return false;
    }
}
