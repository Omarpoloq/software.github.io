<!-- hola.php -->


<div class="container">
<?php 
include "conexion.php";
include "funciones.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos enviados desde el formulario
    

    $nombre=$_POST['nombre'];
    $apellido=$_POST['apellido'];
    $correo = $_POST["correo"];
    $rol=$_POST['rol'];
    $contraseña=$_POST['contraseña'];
    $empresa=$_POST['empresa'];
    
    
    if (agregar_usuario($nombre, $apellido, $correo, $rol, $contraseña, $empresa) === "duplicado") {
        setcookie("mensaje", "duplicado", time() + 3600, "/"); // Expira en una hora (3600 segundos)
        // Puedes redirigir de vuelta al formulario o mostrar el mensaje aquí mismo
        header("Location: index.php?pagina=add_user");
        exit;
    } elseif (agregar_usuario($nombre, $apellido, $correo, $rol, $contraseña, $empresa)) {
        setcookie("mensaje", "exito", time() + 3600, "/"); // Expira en una hora (3600 segundos)
        // Redirigir a la página principal con el parámetro
        header("Location: index.php?pagina=add_user");
        exit;
    } else {
        setcookie("mensaje", "error", time() + 3600, "/"); // Expira en una hora (3600 segundos)
        die("Error" . $conexion->error);
    }
    

    }

$query2="SELECT * FROM rol";
$resultado2= $conexion->query($query2);

$query3="SELECT * FROM empresa";
$resultado3= $conexion->query($query3);

?>
<div class="container mt-4">
    <h2>Agregar Usuario</h2>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" onsubmit="return validarContraseñas()">
        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" class="form-control" name="nombre" placeholder="Ingresa el nombre" required>
        </div>
        <div class="form-group">
            <label for="nombre">Apellido:</label>
            <input type="text" class="form-control" name="apellido" placeholder="Ingresa el apellido" required>
        </div>
        <div class="form-group">
            <label for="correo">Correo electrónico:</label>
            <input type="email" class="form-control" name="correo" placeholder="Ingresa el correo electrónico" required>
        </div>
        <div class="form-group">
            <label for="password">Contraseña:</label>
            
            <div class="input-group">
            <input type="password" class="form-control" name="contraseña" id="contraseña" placeholder="Ingresa la contraseña" required>
                    <div class="input-group-append">
                        <span class="input-group-text toggle-password" data-target="#contraseña" >
                            <i class="far fa-eye"></i>
                        </span>
                    </div>
                </div>
        </div>
        <div class="form-group">
                <label for="confirmar-password">Confirmar Contraseña:</label>
                <div class="input-group">
                    <input type="password" class="form-control" name="confirmar_contraseña" id="confirmar-contraseña" placeholder="Confirma la contraseña" required>
                    <div class="input-group-append">
                        <span class="input-group-text  toggle-password" data-target="#confirmar-contraseña">
                            <i class="far fa-eye"></i>
                        </span>
                    </div>
                </div>
                <small id="contraseña-mensaje" class="text-danger"></small>
            </div>
        <div class="form-group">
            <label for="rol">Rol:</label>
            <select class="form-control" name="rol" required>
                <option value="">Selecciona un rol  --</option>
                <?php while($fila= $resultado2->fetch_assoc()): ?>
                    <option value="<?php echo $fila['id'] ?>"><?php echo $fila['nombre'] ?></option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="empresa">Empresa</label>
            <select class="form-control" name="empresa" required>
                <option value="">Selecciona una empresa  --</option>
                <?php while($fila3= $resultado3->fetch_assoc()): ?>
                    <option value="<?php echo $fila3['id'] ?>"><?php echo $fila3['nombre'] ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <button id="btn-guardar" type="submit" class="btn btn-primary">Agregar Usuario</button>
    </form>
</div>

</div>
<script>
    var contraseñaInput = document.getElementById('contraseña');
    var confirmarContraseñaInput = document.getElementById('confirmar-contraseña');
    var mensaje = document.getElementById('contraseña-mensaje');
    var togglePasswordIcons = document.querySelectorAll('.toggle-password');
    var passwordVisible = false;
    
    togglePasswordIcons.forEach(function (icon) {
        icon.addEventListener('click', function () {
            var targetFieldId = icon.getAttribute('data-target');
            var targetField = document.querySelector(targetFieldId);
            passwordVisible = !passwordVisible;
            targetField.type = passwordVisible ? 'text' : 'password';
        });
    });



    confirmarContraseñaInput.addEventListener('input', function () {
        var contraseña = contraseñaInput.value;
        var confirmarContraseña = confirmarContraseñaInput.value;

        if (contraseña !== confirmarContraseña) {
            mensaje.innerHTML = "Las contraseñas no coinciden. Por favor, verifica.";
        } else {
            verificarContraseña(contraseña);
        }
    });

    contraseñaInput.addEventListener('input', function () {
        var contraseña = contraseñaInput.value;
        var confirmarContraseña = confirmarContraseñaInput.value;

        if (contraseña !== confirmarContraseña) {
            mensaje.innerHTML = "Las contraseñas no coinciden. Por favor, verifica.";
        } else {
            verificarContraseña(contraseña);
        }
    });

    function verificarContraseña(password) {
        mensaje.innerHTML = "";

        var longitudValida = password.length >= 8;
        var tieneMayusculas = /[A-Z]/.test(password);
        var tieneMinusculas = /[a-z]/.test(password);
        var tieneNumeros = /[0-9]/.test(password);

        if (!longitudValida) {
            mensaje.innerHTML += "La contraseña debe tener al menos 8 caracteres.<br>";
        }

        else if (!tieneMayusculas) {
            mensaje.innerHTML += "La contraseña debe contener al menos una letra mayúscula.<br>";
        }

        else if (!tieneMinusculas) {
            mensaje.innerHTML += "La contraseña debe contener al menos una letra minúscula.<br>";
        }

        else if (!tieneNumeros) {
            mensaje.innerHTML += "La contraseña debe contener números  .<br>";
        }
        else if ((password.match(/[0-9]/g) || []).length < 3) {
            mensaje.innerHTML = "La contraseña debe contener al menos tres números.";
        }

        
    }

    
</script>