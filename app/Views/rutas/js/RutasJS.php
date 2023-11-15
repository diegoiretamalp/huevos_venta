<script>
    let clientes_ruta = [];
    let lista = document.querySelector('.ms-activity-log');

    $(document).ready(function() {

        $('#btn_cargar_clientes').click(function() {
            //console.log('kie');
            obtenerClientesPorComuna($('#comuna_id').val());
        });

        $('#btn_cargar_cliente').click(function() {
            CargarCliente($('#cliente_id').val());
        });

        $('#btn_finalizar').click(function() {
            console.log('--------------FINALIZAR-------------');
            console.log(clientes_ruta);
            console.log(lista);
            let total_cajas = $('#total_cajas').val();
            let repartidor_id = $('#repartidor_id').val();
            let fecha_ruta = $('#fecha_ruta').val();
            let observacion = $('#observacion').val();
            if (total_cajas != '' && repartidor_id != '' && fecha_ruta != '' && observacion != '') {
                $('#clientes_ruta').val(JSON.stringify(clientes_ruta));
                $('#formulario').submit();
            } else {
                toastr["error"]('1 o más campos son obligatorios, completalos para continuar por favor', "Error de Validación")
            }
            console.log('--------------FINALIZAR-------------');
        });
        console.log(clientes_ruta);
    });

    function CargarCliente(cliente_id) {
        $.ajax({
            url: '<?= base_url('clientes/obtener-cliente/') ?>' + cliente_id, // Nombre de tu archivo PHP
            method: 'post',
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
                    GenerarNuevoClienteRuta(data);
                    toastr["success"](msg, "Gestión Clientes")
                }
            },
            error: function(error) {
                console.log(JSON.stringify(error));
                console.log('Error al obtener los clientes: ' + error);
            }
        });
    }

    function EliminarCliente(cliente_id) {

        const index = clientes_ruta.findIndex((cliente) => parseInt(cliente.id, 10) === cliente_id);

        if (index !== -1) {
            $('#licliente_' + cliente_id).remove();
            clientes_ruta.splice(index, 1);
            generarListaClientes(clientes_ruta);
        }
    }

    function GenerarNuevoClienteRuta(cliente) {

        console.log(cliente);
        var item = document.createElement('li');
        item.id = 'licliente_' + cliente.id;

        let nuevaPosicion = clientes_ruta.length + 1;
        let c_ruta = {
            id: cliente.id,
            posicion: nuevaPosicion
        };
        clientes_ruta.push(c_ruta);

        var options = '';
        for (let index = 1; index <= clientes_ruta.length; index++) {
            options += `<option value="${index}" ${nuevaPosicion == index ? 'selected' : ''}>${index}</option>`;
        }

        item.innerHTML = `
            <div class="ms-btn-icon btn-pill icon d-flex justify-content-around" style="width: 60px;">
                <select class="form-control" disabled name="posicion_${cliente.id}" id="posicion_${cliente.id}">
                    ${options}
                </select>
            </div>
            <i role="button" style="position:absolute; right:0;top:0; max-width:50px; color:red; cursor: pointer;" onclick="EliminarCliente(${cliente.id})" class="fas fa-times-circle fa-2x"></i>
            <br>
            <br>
            <h6>${cliente.nombre} <span class="badge badge-warning">Pendiente</span> <span role="button" id="btn_ver_deuda" onclick="VerDeudasCliente(${cliente.id})" style="cursor: pointer;" class="badge badge-danger">Ver Deuda</span></h6>
            <span> <i class="material-icons">event</i><b>Ultima Compra: </b>${cliente.fecha_ultima_compra}</span>
            <div class="row">
                <div class="col-4">
                    <p class="fs-14"><b>Categoria Favorita: </b>${cliente.categoria_favorita}</p>
                    <p class="fs-14"><b>Precio Favorito: </b>${cliente.precio_favorito}</p>
                </div>
                <div class="col-6">
                    <p class="fs-14"><b>Total Deuda: </b>${cliente.total_deuda}</p>
                    <p class="fs-14"><b>Direccion: </b>${cliente.direccion} <a href="#" target="_blank"> <i class="fas fa-share-square"></i> Abrir Maps</a></p>
                </div>
            </div>
        `;

        lista.appendChild(item);

    }

    function obtenerClientesPorComuna(comunaId) {
        // Realiza una solicitud AJAX para obtener los clientes de la comuna
        $.ajax({
            url: '<?= base_url('clientes/obtener-clientes-ruta') ?>', // Nombre de tu archivo PHP
            method: 'POST',
            data: {
                comuna_id: comunaId
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
    }

    function generarListaClientes(clientes) {
        //lista.innerHTML = ''; // Limpia la lista antes de agregar nuevos elementos

        clientes.forEach(function(cliente, vuelta_actual) {

            var item = document.createElement('li');
            item.id = 'licliente_' + cliente.id;

            // Verifica si el cliente ya existe en clientes_ruta
            const clienteExistente = clientes_ruta.find((c) => c.id === cliente.id);

            if (!clienteExistente) {
                // Si no existe, agrega el nuevo cliente a clientes_ruta
                let nuevaPosicion = clientes_ruta.length + 1;
                let c_ruta = {
                    id: cliente.id,
                    posicion: nuevaPosicion
                };
                clientes_ruta.push(c_ruta);

                var options = '';
                for (let index = 1; index <= clientes_ruta.length; index++) {
                    options += `<option value="${index}" ${nuevaPosicion == index ? 'selected' : ''}>${index}</option>`;
                }

                item.innerHTML = `
            <div class="ms-btn-icon btn-pill icon d-flex justify-content-around" style="width: 60px;">
                <select class="form-control" disabled name="posicion_${cliente.id}" id="posicion_${cliente.id}">
                    ${options}
                </select>
            </div>
            <i role="button" style="position:absolute; right:0;top:0; max-width:50px; color:red; cursor: pointer;"  class="fas fa-times-circle fa-2x"></i>
            <br>
            <br>
            <h6>${cliente.nombre} <span class="badge badge-warning">Pendiente</span> <span role="button" id="btn_ver_deuda" onclick="VerDeudasCliente(${cliente.id})" style="cursor: pointer;" class="badge badge-danger">Ver Deuda</span></h6>
            <span> <i class="material-icons">event</i><b>Ultima Compra: </b>${cliente.fecha_ultima_compra}</span>
            <div class="row">
                <div class="col-4">
                    <p class="fs-14"><b>Categoria Favorita: </b>${cliente.nombre_producto_favorito}</p>
                    <p class="fs-14"><b>Precio Favorito: </b>${cliente.precio_favorito}</p>
                </div>
                <div class="col-6">
                    <p class="fs-14"><b>Total Deuda: </b>${cliente.total_deuda}</p>
                    <p class="fs-14"><b>Direccion: </b>${cliente.direccion} <a href="#" target="_blank"> <i class="fas fa-share-square"></i> Abrir Maps</a></p>
                </div>
            </div>
        `;

                lista.appendChild(item);

            }
            //clientes_ruta.push(c_ruta);
        });


    }

    function actualizarSelectYOptions(cliente_id) {
        // Supongamos que tienes un contenedor para los select en tu HTML con un ID específico, por ejemplo:
        var selectContainer = document.querySelector('#posicion_' + cliente_id);

        // Limpia el contenedor antes de recrear los select
        selectContainer.innerHTML = '';

        // Recorre el array clientes_ruta para recrear los select y las opciones
        clientes_ruta.forEach(function(cliente, index) {
            var select = document.createElement('select');
            select.className = 'form-control';
            select.name = 'posicion_' + cliente.id;
            select.id = 'posicion_' + cliente.id;

            for (let i = 0; i < clientes_ruta.length; i++) {
                var option = document.createElement('option');
                option.value = i;
                option.text = i + 1; // Suma 1 para mostrar la posición
                if (i === cliente.posicion) {
                    option.selected = true;
                }
                select.appendChild(option);
            }

            selectContainer.appendChild(select);
        });
    }

    function VerDeudasCliente(cliente_id) {
        console.log(cliente_id);
        $.ajax({
            url: '<?= base_url('clientes/obtener-deudas/') ?>' + cliente_id, // Nombre de tu archivo PHP
            method: 'get',
            dataType: 'json',
            success: function(resp) {
                let respuesta = JSON.stringify(resp);
                let obj = $.parseJSON(respuesta);
                let tipo = obj['tipo'];
                let msg = obj['msg'];
                if (tipo != 'success') {
                    toastr[tipo](msg, "Gestión Deudas Clientes")
                } else {
                    data = obj['data'];
                    cargarDatosDeuda(data);
                    //console.log(data);
                    toastr["success"](msg, "Gestión Deudas Clientes")
                }
            },
            error: function(error) {
                console.log(JSON.stringify(error));
                console.log('Error al obtener los clientes: ' + error);
            }
        });
        $('#modal_deudas').modal('show');
    }

    function cargarDatosDeuda(data) {
        let tbody = '';
        let count = 1;
        data.forEach(d => {
            tbody += `
            <tr>
                <td>${count}</td>
                <td>${d.total_venta}</td>
                <td>${d.total_pagado}</td>
                <td>${d.created_at}</td>
            </tr>
            `;

            count++;
        });
        $('#tbody_deudas').html(tbody);
        // Inicializar DataTable solo si aún no ha sido inicializado
        if (!$.fn.DataTable.isDataTable('#table_deudas')) {
            $('#table_deudas').DataTable();
        }
    }
</script>