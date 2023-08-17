<?php
session_start(); // Iniciar la sesión

// Función para validar si el usuario ha iniciado sesión
function validar_sesion() {
    if (!isset($_SESSION["rol"]) || !isset($_SESSION["nombre"])) {
        // Si el usuario no ha iniciado sesión, redireccionarlo al formulario de inicio de sesión
        header("Location: login.php");
        exit;
    }
}

function cerrar_sesion(){
    session_unset();
    session_destroy();
}

function obtener_nombre_del_usuario($usuario) {
    $query = "SELECT nombre FROM usuario  WHERE correo = '$usuario'";
    include 'conexion.php';
    $resultado = $conexion->query($query);

    if ($resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc();
        return $fila['nombre'];
    }

    return null; // Si no se encontró el usuario o el rol, retornar null o manejar el caso en consecuencia
}

function obtener_rol_del_usuario($usuario) {
    $query = "SELECT rol.nombre AS rol FROM usuario JOIN rol ON rol_id = rol.id WHERE correo = '$usuario'";
    include 'conexion.php';
    $resultado = $conexion->query($query);

    if ($resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc();
        return $fila['rol'];
    }

    return null; // Si no se encontró el usuario o el rol, retornar null o manejar el caso en consecuencia
}

function obtener_empresa_del_usuario($usuario) {
    $query = "SELECT empresa.nombre AS empresa FROM usuario JOIN empresa ON empresa_id = empresa.id WHERE correo = '$usuario'";
    include 'conexion.php';
    $resultado = $conexion->query($query);

    if ($resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc();
        return $fila['empresa'];
    }

    return null; // Si no se encontró el usuario o la empresa, retornar null o manejar el caso en consecuencia
}

function validar_credenciales($usuario, $contrasena) {
    $query = "SELECT contrasena FROM usuario WHERE correo = '$usuario'";
    include 'conexion.php';
    $resultado = $conexion->query($query);

    if ($resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc();
        $clave = $fila['contrasena'];
        if (password_verify($contrasena, $clave)) {
            return true;
        }
    }

    return false; // Si no se encontró el usuario o la contraseña no coincide, retornar false
}

function agregar_usuario($nombre, $apellido, $correo, $rol, $contraseña, $empresa) {
    $fullname = $nombre . " " . $apellido;

    $cript = password_hash($contraseña, PASSWORD_DEFAULT);

    include 'conexion.php';

    // Verificar si el usuario ya existe por correo electrónico
    $query_existencia = "SELECT COUNT(*) AS total FROM usuario WHERE correo = '$correo'";
    $resultado_existencia = $conexion->query($query_existencia);
    $fila_existencia = $resultado_existencia->fetch_assoc();

    if ($fila_existencia['total'] > 0) {
        
        return "duplicado";
    }

    
    $query = "INSERT INTO usuario(nombre, rol_id, correo, contrasena, empresa_id) VALUES('$fullname', '$rol', '$correo', '$cript', '$empresa')";
    $resultado = $conexion->query($query);

    if ($resultado) {
        return true;
    } else {
       
        return false;
    }
}

function eliminar_usuario($id_usuario){
    include "conexion.php";

    $query="DELETE FROM usuario WHERE id = '$id_usuario'";
    $resultado=$conexion->query($query);
    if($resultado){
        return true;
    }
    return false;
}

function eliminar_empresa($id_empresa){
    include "conexion.php";

    $query="DELETE FROM empresa WHERE id = '$id_empresa'";
    $resultado=$conexion->query($query);
    if($resultado){
        return true;
    }
    return false;
}



function agregar_empresa($nombre,$direccion,$contacto){
    include "conexion.php";

    $query_existencia = "SELECT COUNT(*) AS total FROM empresa WHERE nombre = '$nombre'";
    $resultado_existencia = $conexion->query($query_existencia);
    $fila_existencia = $resultado_existencia->fetch_assoc();

    if ($fila_existencia['total'] > 0) {
        
        return "duplicado";
    }

    $query="INSERT INTO empresa(nombre,direccion,contacto) VALUES('$nombre','$direccion','$contacto')";
    $resultado=$conexion->query($query);
    if ($resultado) {
     return true;
    } else {
       return false;
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'eliminar_usuario') {
    if (isset($_POST['id_usuario'])) {
        $usuarioId = $_POST['id_usuario'];
        
        // Llama a la función para eliminar el usuario y obtén el resultado
        $eliminado = eliminar_usuario($usuarioId);

        // Envía una respuesta al cliente
        echo $eliminado ? 'true' : 'false';
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'eliminar_empresa') {
    
        $empresaId = $_POST['id_empresa'];

        // Llama a la función para eliminar el usuario y obtén el resultado
        $eliminado = eliminar_empresa($empresaId);
        // Envía una respuesta al cliente
        echo $eliminado ? 'true' : 'false';
    
}





?>
