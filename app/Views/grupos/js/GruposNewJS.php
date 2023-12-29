<script>
    $(document).ready(function() {
        $('#cargar_clientes').click(function() {
            let comuna_id = $('#comuna_id').val();
            let cliente_id = $('#cliente_id').val();

            if (comuna_id > 0) {
                $.ajax({
                    url: '<?= base_url('clientes/obtener-clientes-ruta') ?>', // Nombre de tu archivo PHP
                    method: 'POST',
                    data: {
                        comuna_id: comuna_id,
                    },
                    dataType: 'json',
                    success: function(resp) {
                        let respuesta = JSON.stringify(resp);
                        let obj = $.parseJSON(respuesta);
                        let tipo = obj['tipo'];
                        let msg = obj['msg'];
                        if (tipo != 'success') {
                            toastr[tipo](msg, "Gestión Clientes")
                        } else {
                            data = obj['data'];
                            generarListaClientes(data);
                            //console.log(data);
                            toastr["success"](msg, "Gestión Clientes")
                        }
                    },
                    error: function(error) {
                        console.log(JSON.stringify(error));
                        console.log('Error al obtener los clientes: ' + error);
                    }
                });
            } else {

            }
        });
        $('#comuna_id').change(function() {
            var comunaId = $(this).val();
            // Oculta todos los sectores
            $('#cliente_id option').hide();
            // Muestra solo los sectores que pertenecen a la comuna seleccionada
            $('#cliente_id option[comuna-data="' + comunaId + '"]').show();
        });
    });

    function generarListaClientes() {
        let tbody = '';
        let count = 1;
        let accion = `
        `;
        data.forEach(d => {
            tbody += `
            <tr>
                <td>${count}</td>
                <td>${d.nombre}</td>
                <td>${d.direccion}</td>
                <td>${d.celular != null ? d.celular : 'Sin Información'}</td>
                <td>
                    <button class="btn btn-sm btn-danger" style="font-size:12px" type="button" onclick="EliminarClienteGrupo">Eliminar</button>
                </td>
            </tr>
            `;

            count++;
        });
        $('#table_clientes_tbody').html(tbody);
        // Inicializar DataTable solo si aún no ha sido inicializado
        if (!$.fn.DataTable.isDataTable('#table_clientes')) {
            $('#table_clientes').DataTable();
        }
    }

    function EliminarClienteGrupo(){

    }
</script>