<script>
   $(document).ready(function() {
     
   });

   function EliminarCliente(cliente_id) {
      let table = $('#data-table').DataTable();
      
      if (cliente_id > 0) {
         $.ajax({
            url: "<?php echo base_url('clientes/eliminar') ?>",
            type: "POST",
            data: {
                cliente_id: cliente_id,
            },
            success: function(resp) {
               if (resp == 'ok') { // SI SE ELIMINA CLIENTE
                //   table.row('.selected_fila').remove().draw(false);
                  toastr["success"](`Cliente Eliminado Correctamente`, "Mantenedor de Clientes")
               } else { // SE NOTIFICA ERROR
                  toastr["error"](`${resp}`, "Error Interno")
               }

            },
            error: function(error) {

               console.log(JSON.stringify(error))
            }
         });
      } else {
         toastr["error"](`Ha ocurrido un error al eliminar el Cliente. Recargue e intente nuevamente.`, "Error de validación")
      }
    }
</script>
<style>
   .selected_fila {
      background-color: #354A5F !important;
      color: #fff;
   }
</style>