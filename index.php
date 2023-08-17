<?php 
include "funciones.php";
include "conexion.php";
validar_sesion();


?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>SB Admin 2 - Dashboard</title>

    <!-- Custom fonts for this template-->
    <script src="https://kit.fontawesome.com/70e71cb805.js" crossorigin="anonymous"></script>
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
       <?php include "sidebar.php" ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include "topbar.php" ?>
                <!-- End of Topbar -->
                

                <!-- Begin Page Content -->
                <div id="contenido_principal" class="container-fluid">
                
                    <h1>Contenido</h1>
                </div>
                <!-- End Begin Page Content -->

                   
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Listo para finalizar?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Selecciona "Cerrar sesión" a continuación si estás listo para finalizar tu sesión actual..</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    <a class="btn btn-primary" href="cerrar.php">Cerrar sesión</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
    <!-- Datatables-->
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.js"></script>  
    <!-- Datatables responsive -->
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>

    
    <!-- Sweet alert  -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>
<script>
   
function cargarContenido(url, contenedor) {
    $.ajax({
        url: url,
        type: 'GET',
        dataType: 'html',
        success: function(data) {
            $(contenedor).html(data);
        },
        error: function(xhr, status, error) {
            console.error('Error al cargar el contenido:', error);
        }
    });
}

  $(document).ready(function() {
    // Capturar el evento de clic en los enlaces del sidebar
    var urlParams = new URLSearchParams(window.location.search);
    var pagina = urlParams.get('pagina');

    // Llamar a la función para cargar el contenido según el valor de 'pagina'
    if (pagina) {
        cargarContenido(pagina + '.php', '#contenido_principal');
    }

    // Capturar el evento de clic en los enlaces del sidebar
    $('#agregar_usuario, #lista_usuario, #agregar_empresa,#lista_maquina').on('click', function(event) {
        event.preventDefault();

        // Obtener la URL de destino del enlace
        var url = $(this).attr('href');

        // Realizar una solicitud AJAX para obtener el contenido de la página correspondiente
        cargarContenido(url, '#contenido_principal');
    });
    

  // Define un mapeo de tipos de alerta a mensajes y estilos de SweetAlert
  var alertas = {
        exito: {
            titulo: "Agregado",
            mensaje: "Ha sido agregado exitosamente.",
            icono: "success"
        },
        advertencia: {
            titulo: "Advertencia",
            mensaje: "Hay una advertencia importante.",
            icono: "warning"
        },
        error: {
            titulo: "Error",
            mensaje: "¡Algo salió mal!",
            icono: "error"
        },
        duplicado:{
            titulo: "Error",
            mensaje: "¡El correo electrónico ya está registrado!",
            icono: "error"
        },
        empresa_duplicada:{
            titulo: "Error",
            mensaje: "¡La empresa ya está registrada!",
            icono: "error"
        }
        // Puedes agregar más tipos de alerta aquí si es necesario
    };
    function getCookie(name) {
            var value = "; " + document.cookie;
            var parts = value.split("; " + name + "=");
            if (parts.length === 2) {
                return parts.pop().split(";").shift();
            }
        }
    // Obtén el valor de la cookie "usuario_agregado"
    var mensaje = getCookie("mensaje");

    // Mostrar la alerta correspondiente según el valor de la cookie
    if (alertas.hasOwnProperty(mensaje)) {
        var alerta = alertas[mensaje];
        Swal.fire({
            title: alerta.titulo,
            text: alerta.mensaje,
            icon: alerta.icono
        });

        // Eliminar la cookie
        document.cookie = "mensaje=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
    }

    
     
});



</script>


