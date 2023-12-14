<script>
   $(document).ready(function() {

   });

   function EliminarSector(sector_id) {
      let table = $('#data-table').DataTable();
      $('#row_' + sector_id).addClass('selected_fila');

      if (sector_id > 0) {
         Swal.fire({
            title: '¿Estás seguro?',
            text: '¿Quieres eliminar este sector?',
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
                  url: "<?php echo base_url('sectores/eliminar') ?>",
                  type: "POST",
                  data: {
                     sector_id: sector_id,
                  },
                  success: function(resp) {
                     if (resp == true) {
                        // Si se elimina el sector
                        table.row('.selected_fila').remove().draw(false);
                        toastr["success"](`Sector Eliminado Correctamente`, "Mantenedor de Sector");
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
               $('#row_' + sector_id).removeClass('selected_fila');
            }
         });
      } else {
         toastr["error"](`Ha ocurrido un error al eliminar el Sector. Recargue e intente nuevamente.`, "Error de validación");
      }
   }
</script>
<style>
   .selected_fila {
      background-color: #354A5F !important;
      color: #fff;
   }
</style>