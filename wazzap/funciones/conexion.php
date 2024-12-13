<?php
/* Conexion.php */
/*  PHP 4 Creamos la conexion con la base de datos y vemos si todo ha salido bien */
function conectarBD()
{
    /* PHP  4.1 Necesitaremos los parametros servidor = ruta donde esta la base de datos, usuario, contraseña y nombre de la tabla en la base de datos */
    $servidor = "localhost";
    $usuario = "root";
    $pass = "";
    $tabla = "wazzap";
    /*  PHP 4.2 Creamos la conexion con la base de datos usando mysqli y pasandole los parametros */
    $conexion = new mysqli($servidor, $usuario, $pass, $tabla);
    /* PHP 4.3 Si la conexion ha salido mal, mostramos un mensaje de lo contrario se mandara un booleano afirmativo*/
    if ($conexion->connect_error) {
        die("Conexión fallida: " . $conexion->connect_error);
    }
    return $conexion;
}
