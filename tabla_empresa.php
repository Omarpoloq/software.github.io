<div class="container">
    <?php  include "conexion.php"?>
<div class="container mt-4">
    <h2>Lista de empresas</h2>
    <div class="table-responsive">
        <table id="registros" class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>dirrecion</th>
                    <th>contacto</th>
                    <th>Accion</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Aquí deberías obtener los datos de la base de datos y rellenar la tabla con ellos
                // Ejemplo:
                $query = "SELECT * FROM empresa ";
                $resultado = $conexion->query($query);
                $i=1;
                while ($fila = $resultado->fetch_assoc()):
                ?>
                <tr>
                    <td><?php echo $i++?></td>
                    <td><?php echo ucwords($fila['nombre']); ?></td>
                    <td><?php echo $fila['direccion']; ?></td>
                    <td><?php echo $fila['contacto']; ?></td>
                    <td>
                    <a href="" class="eliminar-enlace" data-id="<?php echo $fila['id']; ?>"><i class="fa-solid fa-trash" style="color: #f50000;"></i>Eliminar</a>
                        <a href="#"><i class="fa-regular fa-pen-to-square" style="color: #0040ff;"></i>Editar</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>
<script>
        $(document).ready(function(){
            $('#registros').DataTable({
                responsive: false,
                language: {
        lengthMenu: "Mostrar _MENU_ registros por página",
        zeroRecords: "Ningún usuario encontrado",
        info: "Mostrando de _START_ a _END_ de un total de _TOTAL_ registros",
        infoEmpty: "Ningún usuario encontrado",
        infoFiltered: "(filtrados desde _MAX_ registros totales)",
        search: "Buscar:",
        loadingRecords: "Cargando...",
        paginate: {
            first: "Primero",
            last: "Último",
            next: "Siguiente",
            previous: "Anterior"
        },scrollY: false
    }
                
            });
            
        });

        function mostrarAlerta(titulo, mensaje, icono) {
            Swal.fire({
                title: titulo,
                text: mensaje,
                icon: icono
            });
        }
        function eliminarEmpresa(empresaId) {
            // Realizar una solicitud POST a funciones.php para llamar a la función eliminar_usuario
            $.ajax({
                url: 'funciones.php',
                type: 'POST',
                data: { action: 'eliminar_empresa', id_empresa: empresaId }, // Ajusta el nombre del parámetro si es necesario
                success: function (response) {
                    if (response === 'true') {
                        // Mostrar una alerta de éxito después de la eliminación
                        mostrarAlerta('Eliminado', 'La empresa ha sido eliminado exitosamente.', 'success');
                        setTimeout(function () {
                    window.location.href = 'index.php?pagina=tabla_empresa'; // Cambia 'pagina_destino.html' a la URL de la página a la que quieres redirigir
                }, 1000); // 3000 milisegundos = 3 segundos

                    } else {
                        // Mostrar una alerta de error si la eliminación falla
                        mostrarAlerta('Error', 'No se pudo eliminar la empresa.', 'error');
                        
                    }
                },
                error: function () {
                    // Mostrar una alerta de error si la solicitud AJAX falla
                    mostrarAlerta('Error', 'No se pudo completar la solicitud.', 'error');
                }
            });
        }


        $('.eliminar-enlace').click(function (e) {
            e.preventDefault();
            var empresaId = $(this).data('id');
            // Mostrar la alerta de SweetAlert
            Swal.fire({
                title: '¿Estás seguro?',
                text: 'Esta acción eliminará a la empresa seleccionada',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Llamar a la función PHP para eliminar el usuario
                    eliminarEmpresa(empresaId);
                }
            });
        });

        

       
    </script>

</div>