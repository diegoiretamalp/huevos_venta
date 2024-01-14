<script>
    $(document).ready(function() {
        $('#fecha_ruta').val('<?= !empty($post['fecha_ruta']) ?  format_datepicket($post['fecha_ruta']) : format_datepicket(getDateToday()) ?>')
        $('#fecha_rutadate').keydown(function(event) {
            event.preventDefault();
        })
        //$('#data-table').DataTable();
    });

    function EliminarRuta(ruta_id) {
      let table = $('#data-table').DataTable();
      $('#row_' + ruta_id).addClass('selected_fila');

      if (ruta_id > 0) {
         Swal.fire({
            title: '¿Estás seguro?',
            text: '¿Quieres eliminar esta Ruta?, Se eliminarán las ventas, pagos y registros de la Ruta',
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
                  url: "<?php echo base_url('rutas/eliminar') ?>",
                  type: "POST",
                  data: {
                     ruta_id: ruta_id,
                  },
                  success: function(resp) {
                     if (resp == true) {
                        // Si se elimina el sector
                        table.row('.selected_fila').remove().draw(false);
                        toastr["success"](`Ruta Eliminada Correctamente`, "Administración de Rutas");
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
               $('#row_' + ruta_id).removeClass('selected_fila');
            }
         });
      } else {
         toastr["error"](`Ha ocurrido un error al eliminar la Ruta. Recargue e intente nuevamente.`, "Error de validación");
      }
   }
</script>
<style>
   .selected_fila {
      background-color: #354A5F !important;
      color: #fff;
   }
</style>