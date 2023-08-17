<?php
session_start();
session_unset();

// Destruir la sesión
session_destroy();

// Redireccionar al formulario de inicio de sesión después de cerrar sesión
header("Location: login.php");
exit;
?>
