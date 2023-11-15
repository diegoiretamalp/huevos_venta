<script>
   $(document).ready(function() {
     
   });

   function EliminarSector(sector_id) {
      let table = $('#data-table').DataTable();
      if (sector_id > 0) {
         $.ajax({
            url: "<?php echo base_url('sectores/eliminar') ?>",
            type: "POST",
            data: {
                sector_id: sector_id,
            },
            success: function(resp) {
               if (resp == 'ok') { // SI SE ELIMINA CLIENTE
                //   table.row('.selected_fila').remove().draw(false);
                  toastr["success"](`Sector Eliminado Correctamente`, "Mantenedor de Sector")
               } else { // SE NOTIFICA ERROR
                  toastr["error"](`${resp}`, "Error Interno")
               }

            },
            error: function(error) {

               console.log(JSON.stringify(error))
            }
         });
      } else {
         toastr["error"](`Ha ocurrido un error al eliminar el Sector. Recargue e intente nuevamente.`, "Error de validación")
      }
    }
</script>
<style>
   .selected_fila {
      background-color: #354A5F !important;
      color: #fff;
   }
</style>