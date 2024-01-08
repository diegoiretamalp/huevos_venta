<script>
    let clientes_grupo = <?= !empty($clientes_grupo) ? json_encode($clientes_grupo) : '[]' ?>;
    $(document).ready(function() {
        console.log(clientes_grupo);
        generarListaClientesInicializa();
        $('#cargar_clientes').click(function() {
            let comuna_id_valida = validaCampos($('#comuna_id').val(), 'comuna_id', 'option', true);
            let cliente_id_valida = validaCampos($('#cliente_id').val(), 'cliente_id', 'option', false);

            let comuna_id = $('#comuna_id').val();
            let cliente_id = $('#cliente_id').val();

            if (comuna_id_valida == 1 && cliente_id_valida == 1) {
                $.ajax({
                    url: '<?= base_url('clientes/obtener-clientes-ruta') ?>', // Nombre de tu archivo PHP
                    method: 'POST',
                    data: {
                        comuna_id: comuna_id,
                        cliente_id: cliente_id,
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
            $('#option_cero').show();
            $('#cliente_id').val("");
        });

        $('#btn_crear_grupo').click(function() {
            // let comuna_id = validaCampos($('#comuna_id').val(), 'comuna_id', 'option', true);
            let nombre = validaCampos($('#nombre').val(), 'nombre', 'text_min', true);

            if (nombre == 1) {
                console.log(clientes_grupo);
                if (clientes_grupo.length > 0) {
                    const clientesGrupoJSON = JSON.stringify(clientes_grupo);
                    if (clientesGrupoJSON) {
                        $('#clientes_grupo').val(clientesGrupoJSON);
                        $('#formulario').submit();
                    } else {
                        toastr["error"](`Ingrese Clientes al grupo para continuar.`, "Error de Validación")
                    }
                } else {
                    toastr["error"](`Ingrese Clientes al grupo para continuar.`, "Error de Validación")
                }
            } else {
                toastr["error"](`Se encontraron 1 o más Campos con Problemas. Corrija e Intente nuevamente`, "Error de Validación")
            }
        });

    });

    function EliminarCliente(cliente_id) {
        console.log(cliente_id);
        const index = clientes_grupo.findIndex((c) => parseInt(c.id) === cliente_id);
        console.log(index);
        console.log(clientes_grupo);
        if (index !== -1) {
            let table = $('#table_clientes').DataTable();
            $('#row_' + cliente_id).addClass('selected_fila');

            // Remove the client from the array
            clientes_grupo.splice(index, 1);

            // Remove the DataTable row
            table.row('.selected_fila').remove().draw(false);

            // Remove the corresponding HTML element from the DOM
            $('#row_' + cliente_id).remove();
        } else {
            toastr["error"](`Cliente no existe o fue eliminado`, "Error de Validación");
        }
    }



    function generarListaClientes(clientes) {
        let tbody = '';
        let count = 1;
        let accion = `
        `;
        clientes.forEach(d => {

            const clienteExistente = clientes_grupo.find((c) => c.id === d.id);

            if (!clienteExistente) {
                let c_ruta = {
                    id: d.id,
                    posicion: count,
                    cliente_data: d
                };
                clientes_grupo.push(c_ruta);
            }

        });

        if (clientes_grupo.length > 0) {
            clientes_grupo.forEach(cliente => {
                tbody += `
                <tr id="row_${cliente.cliente_data.id}">
                <td>${count}</td>
                <td>${cliente.cliente_data.nombre}</td>
                <td>${cliente.cliente_data.direccion}</td>
                <td>${cliente.cliente_data.celular != null ? cliente.cliente_data.celular : 'Sin Información'}</td>
                <td>
                <button class="btn btn-sm btn-danger" style="font-size:12px" type="button" onclick="EliminarCliente(${cliente.cliente_data.id})">Eliminar</button>
                </td>
                </tr>
                `;
                count++;
            });
        }
        $('#table_clientes_tbody').html(tbody);
        // Inicializar DataTable solo si aún no ha sido inicializado
        if (!$.fn.DataTable.isDataTable('#table_clientes')) {
            $('#table_clientes').DataTable();
        }
    }

    function generarListaClientesInicializa() {
        let tbody = '';
        let count = 1;
        if (clientes_grupo.length > 0) {
            clientes_grupo.forEach(cliente => {
                tbody += `
                <tr id="row_${cliente.cliente_data.id}">
                <td>${count}</td>
                <td>${cliente.cliente_data.nombre}</td>
                <td>${cliente.cliente_data.direccion}</td>
                <td>${cliente.cliente_data.celular != null ? cliente.cliente_data.celular : 'Sin Información'}</td>
                <td>
                <button class="btn btn-sm btn-danger" style="font-size:12px" type="button" onclick="EliminarCliente(${cliente.cliente_data.id})">Eliminar</button>
                </td>
                </tr>
                `;
                count++;
            });
        }
        $('#table_clientes_tbody').html(tbody);
        // Inicializar DataTable solo si aún no ha sido inicializado
        if (!$.fn.DataTable.isDataTable('#table_clientes')) {
            $('#table_clientes').DataTable();
        }
    }

    function EliminarClienteGrupo(cliente_id) {
        let table = $('#table_clientes').DataTable();
        $('#row_' + cliente_id).addClass('selected_fila');
        console.log(clientes_grupo);
        if (cliente_id > 0) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: '¿Quieres eliminar este cliente?',
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
                            cliente_id: cliente_id,
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