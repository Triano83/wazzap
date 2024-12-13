# Proyecto de Gestión de Contactos y Mensajes

Este proyecto es una aplicación web desarrollada en PHP que permite la gestión de contactos y el envío de mensajes. La aplicación incluye un sistema de autenticación, un formulario de registro y funcionalidades para agregar y gestionar contactos.

## Características del Proyecto
- Sistema de autenticación de usuarios.
- Formulario de registro para nuevos usuarios.
- Gestión de contactos.
- Envío de mensajes a los contactos.

### Tablas de la Base de Datos
- **Usuario**: Tabla para almacenar la información de los usuarios.
- **Contacto**: Tabla para almacenar los contactos de los usuarios.
- **Mensaje**: Tabla para almacenar los mensajes enviados a los contactos.

### Estructura del Proyecto
- `login.php`: Página principal para el inicio de sesión.
- `index.php`: Página principal a la que se accede después de iniciar sesión.
- `registro.php`: Página de registro para nuevos usuarios.
- `contactos.php`: Página para ver y gestionar contactos.
- `mensaje.php`: Página para enviar mensajes a contactos.

### Requisitos
- PHP 7.4 o superior
- MySQL 5.7 o superior
- Servidor Web Apache

### Instalación

1. **Clonar el repositorio**
    ```sh
    git clone https://github.com/Triano83/wazzap.git
    ```

2. **Configurar la base de datos**
    - Crear una base de datos MySQL y ejecutar el script de creación de tablas `database.sql`.

3. **Configurar el archivo de conexión**
    - Editar el archivo `conexion.php` con los detalles de la base de datos.

4. **Levantar el servidor web**
    - Configurar tu servidor web Apache para que apunte al directorio del proyecto.

### Uso

1. **Registro de usuarios**
    - Acceder a `registro.php` para crear una nueva cuenta de usuario.

2. **Inicio de sesión**
    - Acceder a `login.php` para iniciar sesión con tu cuenta.

3. **Gestión de contactos**
    - Después de iniciar sesión, acceder a `index.php` para ver, agregar y gestionar tus contactos.

4. **Envío de mensajes**
    - Desde la página de gestión de contactos, pulsar sobre un contacto para enviarle un mensaje.

### Código Embebido

#### Ejemplo de Conexión a la Base de Datos en PHP
```php
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "wazzap";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
echo "Conexión exitosa";
?>
/* xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx */
GUIA COMENTADA PASO A PASO

LOGIN.PHP

 HTML 1 Creamos la pagina de loggin
 HTML 1.1 Creamos los includes que vallamos a usar, en este caso el header y el footer
 HTML 1.2 Creamos una imagen dinamica para crear la cuenta en el header y hemos usado include para llamar a todo el header.php
 HTML 1.3 Creamos un formulario para ingresar nuestra cuenta si es que ya tenemos una. Usamos el metodo post y lo mandamos a nuestra misma pantalla de login
 HTML 1.4 Creamos boton para crear cuenta si no tenemos
 HTML 1.5 llamamos a footer.php para que se cargue el footer (haciendo include)

 PHP 2 Necesitaremos usar sesion para mantener el usuario
 PHP 2.1 Necesitaremos usar las funciones relacionadas con el usuario asi que usamos el require once y la clase User
 PHP 2.2 Como queremos rescatar los datos del formulario usamos el método POST
 PHP 2.2.1 preguntamos si el usuario ha enviado el formulario por metodo post y si es asi almacenamos las variables
 PHP 2.3 necesitaremos una funcion que nos diga si el usuario existe y si la contraseña es correcta y le pasamos los datos del usuario
 PHP 2.3.1 Creamos un condicional para saber si el usuario existe y si es así nos manda a index.php
 PHP 2.4 si el usuario existe y la contraseña es correcta entonces creamos una session usuario en la que metemos un objeto usuario
 PHP 2.5 redireccionamos al usuario a la pagina principal

CONEXION.php  
 PHP 4 Creamos la conexion con la base de datos y vemos si todo ha salido bien  
 PHP 4.1 Necesitaremos los parametros servidor = ruta donde esta la base de datos, usuario, contraseña y nombre de la tabla en la base de datos  
 PHP 4.2 Creamos la conexion con la base de datos usando mysqli y pasandole los parametros  
 PHP 4.3 Si la conexion ha salido mal, mostramos un mensaje de lo contrario se mandara un booleano afirmativo

CLASEUSUARIO.PHP
 PHP 5 Creamos la clase usuario
CLASECONTACTO.PHP
 PHP 5.1 Creamos la clase contacto
CLASEMENSAJE.PHP
 PHP 5.2 Creamos la clase mensaje

FUNCIONES USUARIO.PHP  
 Recordar hacer los requires necesarios  
 PHP 3 Creamos un Objeto usuario para meterlo en la sesion  
 PHP 3.1 abrimos conexion
 PHP 3.2 Usamos la sentencia sql para obtener los datos del usuario  
 PHP 3.3 Preparamos la sentencia sql  
 PHP 3.4 Luego usamos bind param para insentarle los valores en las ?
 PHP 3.5 Luego ejecutamos la sentencia sql  
 PHP 3.6 Obtenemos todos los datos de usuarios que coincidan con nuestras query con get Result  
 PHP 3.7 Con esta comprobacion verificamos si hay exastamente 1 dato  
 PHP 3.8 obtenemos el resultado de la query de la primera linea de datos con fetch_assoc  
 PHP 3.9 Creamos el objeto Usuario gracias a los datos almacenados en UsuarioBD  
 PHP 3.10 Cerramos la conexion  
 PHP 3.11 retornamos el objeto usuario  
 PHP 3.12 cerramos conexion
 PHP 3.13 si el resultado de la query no es 1, es decir, no hay usuario con ese telefono y contraseña devuelve false

CREAR CUENTA .PHP  
 HTML 6.2  Creamos el formulario en HTML acordarse de poner enctype = multipart..  
 PHP 6 como vamos hacer un formulario por post tenemos que preguntar si la web recargó con ese metodo y si es así almacenamos los datos en variables para poder usarlos 
 PHP 6.1 llamamos a la funcion crear usuario  para  que nos diga si se ha podido crear el usuario o no

FUNCIONES USUARIO.PHP
 PHP 7 Creamos un usuario para meterlo en la BD 
 PHP 7.1 Primero tenemos que coprobar si ya hay un usuario creado con ese telefono 
 PHP 7.2 Abrimos la conexion 
 PHP 7.3 Usamos la sentencia sql para obtener los datos del usuario 
 PHP 7.4 Preparamos la sentencia sql 
 PHP 7.5 Luego usamos bind param para insentarle los valores en las ?
 PHP 7.6 Luego ejecutamos la sentencia sql 
 PHP 7.7 Obtenemos todos los datos de usuarios que coincidan con nuestras query con get Result 
 PHP 7.8 Con esta comprobacion verificamos si hay exastamente 1 dato 
 PHP 7.9 Aunque tenemos la variable pic tenemos que rescatar el nombre de la imagen y el archivo donde esta guardado temporalmente para luego mandarlo a la carpeta que nosotros queramos
 PHP 7.10 Si se ha guardado correctamente la imagen , creamos el usuario 
 PHP 7.11 Abrimos la conexion 
 PHP 7.12 Usamos la sentencia sql para insertar el usuario 
 PHP 7.13 Preparamos la sentencia sql 
 PHP 7.14 usamos bind param para insertar los valores en las ? 
 PHP 7.15 ejecutamos la sentencia
 PHP 7.16 cerramos la conexion 
 PHP 7.17 retornamos true o false dependiendo de si ha ido bien

  Index 

PHP 8 iniciamos sesion y usamos los requires once que necesitemos
PHP 8.1 Verificar si el usuario está logueado 
PHP 8.2 Si no está logueado, redirigir al login
PHP 8.3 si la web es cargada usando metodo post almacenamos en variables los datos 
necesarios para poder crear un contacto y si el contacto ha sido creado con exito se recarga la web de lo 
contrario nos lanza un mensaje de error
PHP 8.4 si por el contrario la web se ha recargado por otro metodo (get) almacenamos los datos que queremos buscar
PHP 8.4.1 llamamos a la funcion obtenerContacto y le ofrecemos los datos que buscamos y la id del usuario 
para que filtre la busqueda en la BD
PHP 8.5 para poder escribir js en PHP almacenamos como cadena de texto el codigo js para luego usarlo
PHP 8.5.1 En este caso hemos creado una funcion onclick para que al pulsar se despliegue un dialog
HTML 8.6 Creamos un formulario method get para filtrar los datos de la BD 
HTML 8.7 inyectando PHP en el htlm hacemos que se ejecute un codigo de js 
PHP Y HTML 8.8 mostramos los contactos especificos que hemos buscados con la funcion ObtenerContactos
    y con el foreach los mostramos uno a uno 
HTML 8.9 Creamos el formulario para crear un contacto mandando los datos por POST y este formulario solo se abre 
al pulsar el boton crear contacto puesto que es un dialog 

MENSAJES

PHP 9 Verificar si el usuario está logueado 
PHP 9.1 Si no está logueado, redirigir al login
PHP 9.2 Comprobar si el formulario se ha enviado mediante POST y si es así almacenar los datos
PHP 9.2.1 Si el mensaje se crea correctamente, redirigir a la página de mensajes del contacto
PHP 9.2.2 Si hay un error al crear el mensaje
PHP 9.3 Si la página se carga mediante GET, obtener el id del contacto y almacenarlo en la sesión
HTML 9.5 Formulario para enviar un nuevo mensaje
HTML 9.6 Campo oculto para almacenar el id del contacto
PHP 9.7 Obtener los mensajes del contacto desde la base de datos
PHP 9.8 Creamos los mensajes con la fecha y el texto

FUNCIONES CONTACTOS

PHP 10.0 Abrimos conexion
PHP 10.1 Preparamos la imagen para que se guarde correctamente en la base de datos y nuestro pc
PHP 10.2 Hacemos la sentencia SQL
PHP 10.3 Preparamos la sentencia SQL
PHP 10.4 Agregamos los datos con bind param a la sentencia
PHP 10.5 Ejecutamos la sentencia sql
PHP 10.6 Cerramos conexion
PHP 10.7 Retornamos el resultado true en caso de que todo salga bien, false en lo contrario
PHP 10.8 Esta funcion nos sirve para obtener un array de contactos
PHP 10.9 Abrimos conexión
PHP 10.10 Hacemos la sentencia SQL
PHP 10.11 Preparamos la sentencia SQL
PHP 10.12 Modificamos la búsqueda para incluir los comodines %
PHP 10.13 Agregamos los datos con bind param a la sentencia
PHP 10.14 Hacemos la sentencia SQL
PHP 10.15 Preparamos la sentencia SQL
PHP 10.16 Agregamos los datos con bind param a la sentencia
PHP 10.17 Ejecutamos la sentencia SQL
PHP 10.18 Le pedimos a la BD que nos muestre los datos y los almacenamos
PHP 10.19 Creamos un while que nos servirá para recorrer todos los datos que nos devuelve la BD y a su vez ir creando objetos Contacto y almacenarlos en un array
PHP 10.20 Cerramos la conexión
PHP 10.21 Retornamos el array de contactos

FUNCIONES MENSAJES
PHP 11.0 Creamos un Objeto usuario para meterlo en la sesion
PHP 11.1 Abrimos conexion
PHP 11.2 Usamos la sentencia sql para obtener los datos del usuario
PHP 11.3 Preparamos la sentencia sql
PHP 11.4 Luego usamos bind param para insentarle los valores en las ?
PHP 11.5 Luego ejecutamos la sentencia sql
PHP 11.6 Obtenemos todos los datos de usuarios que coincidan con nuestras query con get Result
PHP 11.7 Con esta comprobacion verificamos si hay exactamente 1 dato
PHP 11.8 Obtenemos el resultado de la query de la primera linea de datos con fetch_assoc (recordad que fetch_assoc() devuelve un array asociativo y lo va recorriendo)
PHP 11.9 Creamos el objeto Usuario gracias a los datos almacenados en contactoBD (para sacar los datos de este array asociativo que hemos creado con fetch_assoc() usamos la estructura siguiente array['nombre'], array['edad'], etc)
PHP 11.10 Cerramos la conexion
PHP 11.11 Retornamos el objeto usuario
PHP 11.12 Cerramos conexion
PHP 11.13 Si el resultado de la query no es 1, es decir, no hay usuario con ese telefono y contraseña devuelve false