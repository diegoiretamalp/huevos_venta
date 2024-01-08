<script>
    let clientes_ruta = [];
    let lista = document.querySelector('#body_clientes');
    console.log(lista);
    $(document).ready(function() {
        $('#fecha_ruta').focus(function() {
            console.log('siu');
            var dateInput = document.getElementById('fecha_ruta');
            dateInput.click();

            // Dispara el evento clic en el campo de fecha
        })
        $('#btn_cargar_clientes').click(function() {
            //console.log('kie');
            let grupo_id = $('#grupo_id').val();
            obtenerClientesPorGrupo(grupo_id);
        });

        $('#btn_cargar_cliente').click(function() {
            CargarCliente($('#grupo_id').val());
        });

        $('#btn_finalizar').click(function() {
            console.log('--------------FINALIZAR-------------');
            console.log(clientes_ruta);
            console.log(lista);
            let total_cajas = $('#total_cajas').val();
            let repartidor_id = $('#repartidor_id').val();
            let fecha_ruta = $('#fecha_ruta').val();
            let observacion = $('#observacion_ruta').val();
            let total_cajasv = validaCampos(total_cajas, 'total_cajas', 'numero');
            let repartidor_idv = validaCampos(repartidor_id, 'repartidor_id', 'select');
            let observacionv = validaCampos(observacion, 'observacion_ruta', 'texto_min', false);
            let fecha_rutav = validaCampos(fecha_ruta, 'fecha_ruta', 'fecha');
            // let v = validaCampos(total_cajas, 'total_cajas', 'numero');

            if (total_cajasv == 1 && repartidor_idv == 1 && fecha_rutav == 1 && observacionv == 1) {
                if (clientes_ruta.length > 0) {
                    $('#clientes_ruta').val(JSON.stringify(clientes_ruta));
                    $('#formulario').submit();
                } else {
                    toastr["error"]('Cargar clientes a la ruta para continuar por favor.', "Error de Validación")
                }
            } else {
                toastr["error"]('1 o más campos son obligatorios, completalos para continuar por favor', "Error de Validación")
            }
            console.log('--------------FINALIZAR-------------');
        });

        $('#comuna_id').change(function() {
            // Obtiene el valor seleccionado de la comuna
            var comunaId = $(this).val();

            // Oculta todos los sectores
            $('#sector_id option').hide();

            // Muestra solo los sectores que pertenecen a la comuna seleccionada
            $('#sector_id option[comuna-data="' + comunaId + '"]').show();

            // Selecciona la opción "Todas" por defecto en el campo de sector
            $('#sector_id').val(0);
        });



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

    function obtenerClientesPorGrupo(grupo_id) {
        // Realiza una solicitud AJAX para obtener los clientes de la comuna
        $.ajax({
            url: '<?= base_url('clientes/obtener-clientes-grupo') ?>', // Nombre de tu archivo PHP
            method: 'POST',
            data: {
                grupo_id: grupo_id,
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

        // document.getElementById('body_clientes').innerHTML = ``;
        clientes.forEach(function(cliente, vuelta_actual) {

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

                url_ver_detalle = `<?= base_url('clientes/ver/') ?>${cliente.id}`
                itemm = `<div class="col-12 col-sm-6 col-md-4 col-xl-3" id="card_${cliente.id}">
                            <div class="ms-card">
                                <div class="ms-card-header text-center">
                                        <b class="text-danger" onclick=EliminarClienteRuta(${cliente.id}) style="margin-left: 90%; cursor: pointer;"><i class="fas fa-times-circle fa-2x"></i></b>
                                        <h6 class="text-center">${cliente.nombre}</h6>
                                </div>
                                <div class="ms-card-body text-center">
                                    <h6>
                                        <i class="far fa-money-bill-alt p-2"></i> Precio Favorito: <b>${cliente.precio_favorito}</b>
                                    </h6>
                                    <h6>
                                        <i class="fas fa-egg p-2"></i> Producto Favorito: <b>${cliente.nombre_producto_favorito}</b>
                                    </h6>
                                    <h6 class="text-danger">
                                        <i class="far fa-money-bill-alt p-2"></i> Deuda Pendiente: <b>${cliente.total_deuda}</b>
                                    </h6>


                                    <div class="button-group2 d-flex justify-content-center">
                                        <a class="buttonSpecial" target="_blank" href="${url_ver_detalle}" style="background-color: #374eae; color: white;">Ver Detalle</a>
                                        <button class="buttonSpecial" type="button" onclick="VerDeudasCliente(${cliente.id})" style="background-color: red; color: white;">Ver Deudas</button>
                                    </div>
                                    <!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus nunc velit, dictum eget nulla a, sollicitudin rhoncus orci. Vivamus nec commodo turpis.</p> -->
                                </div>
                                <div class="ms-card-footer text-disabled d-flex">
                                    <div class="ms-card-options">
                                        <i class="fas fa-box    "></i> ${cliente.cajas_total}
                                    </div>
                                    <div class="ms-card-options" style="color: green;">
                                        + ${cliente.total_pagado}
                                    </div>
                                </div>
                            </div>
                        </div>`;
                // lista.appendChild(itemm);
                document.getElementById('body_clientes').innerHTML += itemm;
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

    function EliminarClienteRuta(cliente_id) {
        const index = clientes_ruta.findIndex((cliente) => parseInt(cliente.id, 10) === cliente_id);

        if (index !== -1) {
            $('#card_' + cliente_id).remove();
            clientes_ruta.splice(index, 1);
            // generarListaClientes(clientes_ruta);
        }
    }
</script>