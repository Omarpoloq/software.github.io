
<div class="container">
<?php 
include "conexion.php";
include "funciones.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos enviados desde el formulario
    $nombre=$_POST['nombre'];
    $direccion=$_POST['direccion'];
    $contacto=$_POST['contacto'];
    
    if (agregar_empresa($nombre,$direccion,$contacto)==="duplicado") {
      setcookie("mensaje", "empresa_duplicada", time() + 3600, "/"); // Expira en una hora (3600 segundos)

      // Redirigir a la página principal con el parámetro
      header("Location: index.php?pagina=form_empresa");
      exit;
    }
    elseif (agregar_empresa($nombre,$direccion,$contacto)) {
        setcookie("mensaje", "exito", time() + 3600, "/"); // Expira en una hora (3600 segundos)
  
        // Redirigir a la página principal con el parámetro
        header("Location: index.php?pagina=form_empresa");
        exit;
      } 
      else {
        setcookie("mensaje", "error", time() + 3600, "/"); // Expira en una hora (3600 segundos)

      // Redirigir a la página principal con el parámetro
      header("Location: index.php?pagina=form_empresa");
    }
    

    }

?>
<div class="container mt-4">
        <h2>Formulario de Empresa</h2>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre de la Empresa</label>
                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingresa nombre" required>
            </div>
            <div class="mb-3">
                <label for="direccion" class="form-label">Dirección</label>
                <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Ingresa direccion" required>
            </div>
            <div class="mb-3">
                <label for="contacto" class="form-label">Contacto</label>
                <input type="text" class="form-control" id="contacto" name="contacto" placeholder="Ingresa contacto" required>
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
</div>
</div>