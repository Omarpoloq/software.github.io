<?php 
include "conexion.php";
include "funciones.php";

// Verificar si se enviaron los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos enviados desde el formulario
    $usuario = $_POST["usuario"];
    $contrasena = $_POST["contraseña"];

    // Validar las credenciales del usuario
    if (validar_credenciales($usuario, $contrasena)) {
        // Autenticar al usuario

        // Obtener el rol,nombre y la empresa del usuario desde la base de datos 
        $rol = obtener_rol_del_usuario($usuario);
        $nombre=obtener_nombre_del_usuario($usuario);

        // Guardar el rol y la empresa en las variables de sesión para usarlos en otras páginas
        session_start();
        $_SESSION["rol"] = $rol;
        $_SESSION["nombre"] = $nombre;
        

        // Obtener los datos de la empresa desde la base de datos
        //$datos_empresa = obtener_datos_empresa($empresa); // Debes implementar esta función para obtener los datos de la empresa

        // Guardar los datos de la empresa en la variable de sesión
        

        // Redireccionar al usuario a la página de inicio después de iniciar sesión
        header("Location: index.php");
        exit;
    } else {
        // Después de validar el inicio de sesión:
        
        setcookie('error_message', 'Credenciales inválidas. Inténtalo de nuevo.', time() + 60, '/');
          header("Location:login.php");
          exit();
      }
}


?>


