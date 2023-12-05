<script>
    let tableCarrito;
    let cliente_id_venta;
    let carrito = {
        productos: [], // Subarray para almacenar los productos
        costoTotal: 0,
        totalProductos: 0,
        totalCajas: 0
    };
    let ruta_id = '<?= !empty($ruta_id) ? $ruta_id : '' ?>'
    $(document).ready(function() {

        <?php if (!empty($clientes_ruta)) : ?>
            <?php foreach ($clientes_ruta as $cliente) : ?>
                MostrarPrimeraVenta(<?= $cliente->cliente_id ?>, <?= $ruta_id ?>);
            <?php endforeach; ?>
        <?php endif; ?>
        tableCarrito = $('#tableCarrito').DataTable();
        $('#check_pago_total').click(function() {
            $('#monto_pagado').val(carrito.costoTotal);
        });
        $('#monto_pagado').keyup(function() {

            let monto_pagado = $('#monto_pagado').val();

            if (carrito.costoTotal > monto_pagado) {
                $('#check_pago_total').attr('checked', false);
                $('#monto_pagado').attr('disabled', false);
            } else if (monto_pagado >= carrito.costoTotal) {
                $('#check_pago_total').attr('checked', true);
                $('#monto_pagado').val(carrito.costoTotal);
            }
        });
        $('.btn_nueva_venta').click(function() {
            let cliente_id = (this).id;
            cliente_id_venta = (this).id;
            console.log(cliente_id);
            CargarCliente(cliente_id);
        });
        $('#btn_agregar_producto').click(function() {
            let id = $('#producto_id').val();
            AgregarProducto(id);
        });

        $('#btn_finalizar_venta').click(function() {
            let metodo_pago = document.querySelector('input[name="metodo_pago"]:checked').value;

            let monto_pagado = $('#monto_pagado').val();
            let check_pago_total = $('#check_pago_total').val();
            if (carrito.productos.length > 0) {
                let dat = {
                    cliente_id: cliente_id_venta,
                    data: carrito,
                    metodo_pago: metodo_pago,
                    monto_pagado: monto_pagado,
                    check_pago_total: check_pago_total,
                    ruta_id: ruta_id
                };

                $.ajax({
                    url: '<?= base_url('ventas/nueva-venta-ruta') ?>', // Nombre de tu archivo PHP
                    method: 'post',
                    data: dat,
                    dataType: 'json',
                    success: function(resp) {
                        let respuesta = JSON.stringify(resp);
                        let obj = $.parseJSON(respuesta);
                        let tipo = obj['tipo'];
                        let msg = obj['msg'];
                        if (tipo != 'success') {
                            toastr[tipo](msg, "Gestión Clientes")
                        } else {
                            //data = obj['data'];
                            LimpiarCamposModal();
                            toastr["success"](msg, "Gestión Clientes")
                            location.reload();
                            $('#modal-15').modal('hide');
                        }
                    },
                    error: function(error) {
                        console.log(JSON.stringify(error));
                        console.log('Error al obtener los clientes: ' + error);
                    }
                });

            }
        });

        $('.metodo_pago').click(function() {
            let metodo_pago = (this).value;

            console.log('metodo_pago');
            console.log(metodo_pago);
            console.log('metodo_pago');
            switch (metodo_pago) {
                case '1':
                    $('#metodo_pago_seleccionado').html('Fiado');
                    $('#monto_pagado').val(0);
                    $('#monto_pagado').attr('disabled', true);
                    $('#check_pago_total').attr('disabled', true);
                    $('#check_pago_total').attr('checked', false);
                    break;
                case '2':
                    $('#metodo_pago_seleccionado').html('Efectivo');
                    $('#monto_pagado').val(carrito.costoTotal);
                    $('#monto_pagado').attr('disabled', false);
                    $('#check_pago_total').attr('disabled', false);
                    $('#check_pago_total').attr('checked', true);
                    break;
                case '3':
                    $('#metodo_pago_seleccionado').html('Transferencia');
                    $('#monto_pagado').val(carrito.costoTotal);
                    $('#monto_pagado').attr('disabled', false);
                    $('#check_pago_total').attr('disabled', false);
                    $('#check_pago_total').attr('checked', true);
                    break;
                case '4':
                    $('#metodo_pago_seleccionado').html('Deposito');
                    $('#monto_pagado').val(carrito.costoTotal);
                    $('#monto_pagado').attr('disabled', false);
                    $('#check_pago_total').attr('disabled', false);
                    $('#check_pago_total').attr('checked', true);
                    break;
                default:
                    break;
            }
        });

        $('#nuevo_gasto').click(function() {
            $('#modal_gasto').modal('show');
        });
        $('#confirmar_gasto').click(function() {
            let nombre = $('#nombre_gasto').val();
            let monto = $('#monto_gasto').val();
            if (nombre != '' && monto != '' && monto > 0) {
                $.ajax({
                    url: '<?= base_url('gastos/nuevo-gasto-ruta') ?>',
                    method: 'post',
                    data: {
                        nombre: nombre,
                        monto: monto,
                        ruta_id: ruta_id
                    },
                    dataType: 'json',
                    success: function(resp) {
                        let respuesta = JSON.stringify(resp);
                        let obj = $.parseJSON(respuesta);
                        let tipo = obj['tipo'];
                        let msg = obj['msg'];
                        if (tipo != 'success') {
                            toastr[tipo](msg, "Gestión de Gastos")
                        } else {
                            //data = obj['data'];
                            //CargarDatosClienteModal(data);
                            toastr["success"](msg, "Gestión Clientes")
                        }
                    },
                    error: function(error) {
                        console.log(JSON.stringify(error));
                        console.log('Error al obtener los clientes: ' + error);
                    }
                });
            } else {
                toastr['warning']('1 o más campos son requeridos, completalos para continuar por favor.', "Gestión de Gastos")
            }

        });

        $('#cerrar_ruta').click(function(){
            $('#modal_cerrar_ruta').modal('show');
        });

        $('#buscar_cliente').keyup(function () {
    let lista = document.querySelectorAll('#lista li');
    let valor = $(this).val().trim().toLowerCase();

    lista.forEach(element => {
        let h1Element = element.querySelector('h6');
        if (h1Element) {
            let nombre = h1Element.textContent.trim().toLowerCase();

            if (nombre.includes(valor)) {
                element.style.display = '';
            } else {
                element.style.display = 'none';
            }
        }
    });
});


    });

    function EliminarProducto(id_unico) {

        const index = carrito.productos.findIndex(producto => producto.id_unico === id_unico);

        if (index !== -1) {
            carrito.productos.splice(index, 1); // Elimina el elemento en el índice encontrado
            toastr['success']['Producto eliminado con éxito.']
        } else {
            toastr['error']['Producto no encontrado.']
        }
        ActualizarTablaCarrito();
    }

    function CargarCliente(cliente_id) {
        cliente_id_venta = cliente_id
        $.ajax({
            url: '<?= base_url('clientes/cargar-cliente-venta/') ?>' + cliente_id, // Nombre de tu archivo PHP
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
                    CargarDatosClienteModal(data);
                    //toastr["success"](msg, "Gestión Clientes")
                }
            },
            error: function(error) {
                console.log(JSON.stringify(error));
                console.log('Error al obtener los clientes: ' + error);
            }
        });
    }

    function LimpiarCamposModal() {
        $('#cliente_id').html('');

        $('#nombre').val('');
        $('#apellido_paterno').val('');
        $('#apellido_materno').val('');
        $('#rut_factura').val('');
        $('#celular').val('');
        $('#email').val('');
        $('#precio').val(0);
        $('#monto_pagado').val(0);

        //var metodo_pago_id = document.getElementById("metodo_pago_id");
        //metodo_pago_id.selectedIndex = 'fiado';

        var select = document.getElementById("producto_id");
        select.selectedIndex = 0;
        $('#cliente_accordion').html('');
        $('#nombre_completo_cliente').html('');
        $('#rut_factura_cliente').html('');
        $('#contacto_cliente').html('');
        carrito = {
            productos: [],
            costoTotal: 0,
            totalProductos: 0,
            totalCajas: 0
        }
        ActualizarTablaCarrito();
        console.log('-------------------');
        console.log(carrito);
        console.log('-------------------');
    }

    function CargarDatosClienteModal(data) {
        let option = '';
        option += '<option>' + data.nombre + '</option>';
        $('#cliente_id').html(option);

        $('#nombre').val(data.nombre);
        $('#apellido_paterno').val(data.apellido_paterno);
        $('#apellido_materno').val(data.apellido_materno);
        $('#rut_factura').val(data.rut_factura);
        $('#celular').val(data.celular);
        $('#email').val(data.email);
        $('#precio').val(data.precio_favorito);

        var select = document.getElementById("producto_id");
        select.selectedIndex = data.producto_id;

        let nombre_completo = data.nombre + ' ' + data.apellido_paterno + ' ' + data.apellido_materno
        let contacto = data.email + ' - ' + data.celular;
        $('#cliente_accordion').html(nombre_completo);
        $('#nombre_completo_cliente').html(nombre_completo);
        $('#rut_factura_cliente').html(data.rut_factura);
        $('#contacto_cliente').html(contacto);
    }

    function AgregarProducto(id) {
        console.log('---');
        console.log(id);
        console.log('---');
        let articulo;
        switch (id) {
            case '1':
                articulo = 'PRIMERA';
                break;
            case '2':
                articulo = 'SEGUNDA';
                break;
            case '3':
                articulo = 'EXTRA';
                break;
            case '4':
                articulo = 'SUPER EXTRA';
                break;
            default:
                articulo = 'PRIMERA';
                break;
        }
        let cantidad = $('#cantidad').val();
        let precioxunidad = $('#precio').val();
        let tipo_huevo = $('#tipo_huevo').val();
        let formato_huevo = $('#formato_huevo').val();

        var productoExiste = carrito.productos.find(function(producto) {
            return producto.id === id && producto.precio === parseFloat(precioxunidad);
        });

        if (productoExiste) {
            productoExiste.cantidad = parseInt(productoExiste.cantidad) + parseInt(cantidad);
            productoExiste.subtotal = parseInt(precioxunidad) * parseInt(productoExiste.cantidad);
        } else {
            var producto = {
                id_unico: Math.floor(Math.random() * (9999 - 11111 + 1)) + 11111,
                id: id,
                nombre: articulo,
                precio: parseFloat(precioxunidad),
                tipo_huevo: tipo_huevo,
                formato_huevo: formato_huevo,
                cantidad: parseInt(cantidad),
                subtotal: parseFloat(precioxunidad) * parseInt(cantidad),
            }
            carrito.productos.push(producto);
        }

        // Actualizar el costo total del carrito
        carrito.costoTotal = calcularCostoTotal(carrito.productos);

        // Actualizar el total de productos y cajas compradas
        carrito.totalProductos = calcularTotalProductos(carrito.productos);
        carrito.totalCajas = calcularTotalCajas(carrito.productos);

        $('#cantidad').val(1);
        $('#monto_pagado').val(carrito.costoTotal);
        $('#data_carrito').val(JSON.stringify(carrito.productos));
        $('#costo_total').val(carrito.costoTotal);
        $('#total_venta').html(carrito.costoTotal);
        ActualizarTablaCarrito();
    };

    function ActualizarTablaCarrito() {
        tableCarrito.clear();
        let count = 1;
        carrito.productos.forEach(function(producto) {
            tipo_huevo = producto.tipo_huevo == 'b' ? 'BLANCO' : 'COLOR';
            formato_huevo = producto.formato_huevo == 'c' ? 'CAJA' : 'BANDEJA';
            //<button type="button" class="ms-btn-icon btn-pill btn-warning"><i class="flaticon-alert"></i></button>

            let button_eliminar = `<button type="button" onclick="EliminarProducto(${producto.id_unico})" class="ms-btn-icon btn-pill btn-danger d-flex justify-content-center align-items-center"><i class="fas fa-trash" ></i></button>`;
            var fila = [
                count,
                producto.nombre,
                producto.precio,
                tipo_huevo,
                formato_huevo,
                producto.cantidad,
                producto.subtotal,
                button_eliminar
            ]
            tableCarrito.row.add(fila);
        });
        tableCarrito.draw();

        console.log(carrito);
    }

    function calcularCostoTotal(productos) {
        var costoTotal = 0;
        productos.forEach(function(producto) {
            costoTotal += producto.subtotal;
        });
        return costoTotal;
    }

    // Función para calcular el total de productos comprados
    function calcularTotalProductos(productos) {
        var total = 0;
        productos.forEach(function(producto) {
            total += producto.cantidad;
        });
        return total;
    }

    // Función para calcular el total de cajas compradas (cambia esto según tus necesidades)
    function calcularTotalCajas(productos) {
        var total = 0;
        productos.forEach(function(producto) {
            if (producto.tipo === 'Caja') {
                total += producto.cantidad;
            }
        });
        return total;
    }

    function MostrarPrimeraVenta(cliente_id, ruta_id) {

        $.ajax({
            url: '<?= base_url('clientes/cargar-primera-venta') ?>', // Nombre de tu archivo PHP
            method: 'post',
            data: {
                cliente_id: cliente_id,
                ruta_id: ruta_id
            },
            dataType: 'json',
            success: function(resp) {
                let respuesta = JSON.stringify(resp);
                let obj = $.parseJSON(respuesta);
                let tipo = obj['tipo'];
                let msg = obj['msg'];
                if (tipo == 'danger') {
                    console.log('Error al cargar primera vista de cliente');
                } else if (tipo == 'warning') {
                    console.log(msg);
                } else {
                    data = obj['data'];
                    console.log('data');
                    console.log(data);
                    console.log('data');
                    CargarDatosPrimeraVenta(data, cliente_id);
                }
            },
            error: function(error) {
                console.log(JSON.stringify(error));
                console.log('Error al obtener los clientes: ' + error);
            }
        });
    }

    function CargarDatosPrimeraVenta(data, cliente_id) {
        // Ocultar elementos por ID
        $('#' + cliente_id + ', #row_ventas_' + cliente_id).css('display', 'none');

        // Construir el cuerpo de la tabla
        let tbody = '';
        let count = 1;
        let badge = '';
        console.log('data');
        console.log(data);
        console.log('data');
        data.forEach(d => {
            badge = '';
            tbody += `
            <tr>
                <td class="text-center">${count}</td>
                <td class="text-center">${d.nombre_producto}</td>
                <td class="text-center">${d.cantidad}</td>
                <td class="text-center">${d.precio}</td>
                <td class="text-center">${d.precio * d.cantidad}</td>
                <td class="text-center">${d.metodo_pago}</td>`;
            // if (d.pagado == 0) {
            //     badge += `
            //         <span class="badge badge-warning">No</span>
            //     `;
            // } else {
            //     badge += `
            //         <span class="badge badge-success">Si</span>
            //     `;
            // }
            // <td class="text-center">${badge}</td>
            tbody += `
                </tr>
            `;
            count++;
        });
        $('#btn_venta_' + cliente_id).removeAttr('hidden');
        $('#tbody_ventas_' + cliente_id).html(tbody);

        // Inicializar DataTable solo si aún no ha sido inicializado
        if (!$.fn.DataTable.isDataTable('#table_ventas_' + cliente_id)) {
            $('#table_ventas_' + cliente_id).DataTable();
        }
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
        console.log(data);
        data.forEach(d => {
            created_at = ordenarFechaHoraHumano(d.created_at);
            tbody += `
            <tr>
                <td>${count}</td>
                <td>${d.ruta_id}</td>
                <td>${d.total_venta}</td>
                <td>${d.total_pagado}</td>
                <td>${created_at}</td>
            </tr>`;

            count++;
        });
        $('#tbody_deudas').html(tbody);
        // Inicializar DataTable solo si aún no ha sido inicializado
        if (!$.fn.DataTable.isDataTable('#table_deudas')) {
            $('#table_deudas').DataTable();
        }
    }
</script>