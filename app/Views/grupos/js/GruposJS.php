<script>
    $(document).ready(function() {

    });

    function EliminarGrupo(grupo_id) {
        let table = $('#data-table').DataTable();
        $('#row_' + grupo_id).addClass('selected_fila');
        if (grupo_id > 0) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: '¿Quieres eliminar este Grupo?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Usuario hizo clic en "Sí, eliminar"
                    $.ajax({
                        url: "<?php echo base_url('grupos/eliminar') ?>",
                        type: "POST",
                        data: {
                            grupo_id: grupo_id,
                        },
                        success: function(resp) {
                            if (resp == true) {
                                // Si se elimina el sector
                                table.row('.selected_fila').remove().draw(false);
                                toastr["success"](`Grupo Eliminado Correctamente`, "Mantenedor de Grupos");
                            } else {
                                // Si hay un error al eliminar
                                toastr["error"](`${resp}`, "Error Interno");
                            }
                        },
                        error: function(error) {
                            console.log(JSON.stringify(error));
                        }
                    });
                } else {
                    $('#row_' + grupo_id).removeClass('selected_fila');
                }
            });
        } else {
            toastr["error"](`Ha ocurrido un error al eliminar el Grupo. Recargue e intente nuevamente.`, "Error de validación");
        }
    }
</script>
<style>
   .selected_fila {
      background-color: #354A5F !important;
      color: #fff;
   }
</style>