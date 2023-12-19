<script>
    let tableCarrito;
    let carrito = {
        productos: [], // Subarray para almacenar los productos
        costoTotal: 0,
        totalProductos: 0,
        totalCajas: 0
    };
    $(document).ready(function() {
        tableCarrito = $('#tableCarrito').DataTable();
        let comprobante_col = document.getElementById('col_comprobante');
        $('.btn_agregar_producto').click(function() {
            let id = (this).id;
            AgregarProducto(id);
        });

        $('.metodo_pago').click(function() {
            let metodo_pago = (this).value;
            switch (metodo_pago) {
                case 'fiado':
                    $('#monto_pagado').val(0);
                    $('#monto_pagado').attr('disabled', true);
                    $('#check_pago_total').attr('disabled', true);
                    $('#check_pago_total').attr('checked', false);
                    comprobante_col.style.display = 'none';
                    break;
                case 'efectivo':
                    $('#monto_pagado').val(carrito.costoTotal);
                    $('#monto_pagado').attr('disabled', true);
                    $('#check_pago_total').attr('disabled', false);
                    $('#check_pago_total').attr('checked', true);
                    comprobante_col.style.display = 'none';
                    break;
                case 'transferencia':
                    $('#monto_pagado').val(carrito.costoTotal);
                    $('#monto_pagado').attr('disabled', true);
                    $('#check_pago_total').attr('disabled', false);
                    $('#check_pago_total').attr('checked', true);
                    comprobante_col.style.display = 'block';
                    break;
                case 'deposito':
                    $('#monto_pagado').val(carrito.costoTotal);
                    $('#monto_pagado').attr('disabled', true);
                    $('#check_pago_total').attr('disabled', false);
                    $('#check_pago_total').attr('checked', true);
                    comprobante_col.style.display = 'block';
                    break;

                default:
                    break;
            }
        });

        $('#check_pago_total').click(function() {
            let action = (this).checked;
            console.log(carrito);
            if (!action) {
                $('#monto_pagado').attr('disabled', false);
            } else {

                $('#monto_pagado').attr('disabled', true);
                $('#monto_pagado').val(carrito.costoTotal);
            }
        });

        $("#comprobante_pago").change(function() {
            let img = validaImagen('comprobante_pago');
            if (img == '1') {
                let reader = new FileReader();
                let input = event.target;
                reader.onload = function(e) {
                    // Asignamos el atributo src a la tag de imagen
                    $('#comprobante').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            };
        });

        $('#cliente_id').change(function() {

            let cliente_id = (this).value;
            if (cliente_id) {
                $.ajax({
                    url: "<?= base_url("ventas/obtener-cliente") ?>",
                    type: "post",
                    data: {
                        cliente_id: cliente_id,
                    },
                    dataType: 'json',
                    success: function(resp) {
                        let respuesta = JSON.stringify(resp);
                        let obj = $.parseJSON(respuesta);
                        let tipo = obj['tipo'];
                        let resultado = obj['msg'];
                        let data = obj['data'];
                        console.log(data);
                        if (tipo == 'error') {
                            toastr["error"]("Error al obtener Cliente, recargue página e intente nuevamente", "Error de Validación")
                        } else if (tipo == 'warning') {
                            toastr["warning"]("No se han encontrado el Cliente o fue eliminado", "Seleccion de Cliente")
                        } else {
                            HabilitarCamposCliente(true);
                            $('#nombre').val(data.nombre);
                            $('#apellido_paterno').val(data.apellido_paterno);
                            $('#apellido_materno').val(data.apellido_materno);
                            $('#rut_factura').val(data.rut_factura);
                            $('#celular').val(data.celular);
                            $('#email').val(data.email);
                            $('#check_nuevo_cliente').prop('checked', false);
                            toastr["success"]("Cliente cargado!", "Gestión de Clientes")
                        }
                    },
                    error: function(error) {
                        console.log(JSON.stringify(error));
                        toastr["error"](`Error Interno`, "Error de Validación")
                    }
                });
            }

        });

        $('#check_nuevo_cliente').click(function() {
            let action = (this).checked;
            if (action) {
                $('#cliente_id').val(0);
                HabilitarCamposCliente();
            } else {
                HabilitarCamposCliente(true);
            }
            console.log('siu');
        });

    });

    function EliminarVenta(venta_id) {

        Swal.fire({
            title: '¡¡ATENCIÓN!!',
            html: '<h2>¿Estás seguro que quieres eliminar la venta?<br>¡se anularán los pagos realizados!</h2>',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {

                if (venta_id > 0) {
                    $.ajax({
                        url: "<?= base_url("ventas/eliminar") ?>",
                        type: "post",
                        data: {
                            venta_id: venta_id,
                        },
                        dataType: 'json',
                        success: function(resp) {
                            let respuesta = JSON.stringify(resp);
                            let obj = $.parseJSON(respuesta);
                            let tipo = obj['tipo'];
                            let resultado = obj['msg'];
                            let data = obj['data'];
                            console.log(data);
                            if (tipo == 'error') {
                                toastr["error"]("Error al Eliminar Venta, recargue página e intente nuevamente", "Error de Validación")
                            } else {
                                toastr["success"]("Venta eliminada con éxito", "Gestión de Ventas")
                            }
                        },
                        error: function(error) {
                            console.log(JSON.stringify(error));
                            toastr["error"](`Error Interno`, "Error de Validación")
                        }
                    });
                } else {
                    toastr["error"]("Error al Eliminar Venta, recargue página e intente nuevamente", "Error de Validación")
                }
            } else {
                $('#row_' + venta_id).removeClass('selected_fila');
            }
        });

    }

    function HabilitarCamposCliente(habilitar = false) {
        $('#nombre').val('');
        $('#apellido_paterno').val('');
        $('#apellido_materno').val('');
        $('#rut_factura').val('');
        $('#celular').val('');
        $('#email').val('');
        $('#nombre').attr('disabled', habilitar);
        $('#apellido_paterno').attr('disabled', habilitar);
        $('#apellido_materno').attr('disabled', habilitar);
        $('#rut_factura').attr('disabled', habilitar);
        $('#celular').attr('disabled', habilitar);
        $('#email').attr('disabled', habilitar);
    }

    function AgregarProducto(id) {
        let articulo = $('#articulo_' + id).html();
        let cantidad = $('#cantidad_' + id).val();
        let precioxunidad = $('#precioxunidad_' + id).val();
        let precioOriginal = $('#precio_' + id).val();

        var productoExiste = carrito.productos.find(function(producto) {
            console.log(producto.id);
            console.log(producto.precio);
            console.log(id);
            return producto.id === id && producto.precio === parseFloat(precioxunidad);
        });

        if (productoExiste) {
            productoExiste.cantidad = parseInt(productoExiste.cantidad) + parseInt(cantidad);
            productoExiste.subtotal = parseInt(precioxunidad) * parseInt(productoExiste.cantidad);
        } else {
            var producto = {
                id: id,
                nombre: articulo,
                precio: parseFloat(precioxunidad),
                cantidad: parseInt(cantidad),
                subtotal: parseFloat(precioxunidad) * parseInt(cantidad),
                tipo: 'Caja'
            }
            carrito.productos.push(producto);
        }

        // Actualizar el costo total del carrito
        carrito.costoTotal = calcularCostoTotal(carrito.productos);

        // Actualizar el total de productos y cajas compradas
        carrito.totalProductos = calcularTotalProductos(carrito.productos);
        carrito.totalCajas = calcularTotalCajas(carrito.productos);



        $('#cantidad_' + id).val(1);
        $('#precioxunidad_' + id).val(precioOriginal);
        $('#monto_pagado').val(carrito.costoTotal);
        $('#data_carrito').val(JSON.stringify(carrito.productos));
        $('#costo_total').val(carrito.costoTotal);
        ActualizarTablaCarrito();
    };

    function ActualizarTablaCarrito() {
        tableCarrito.clear();
        carrito.productos.forEach(function(producto) {
            var fila = [
                producto.id,
                producto.nombre,
                producto.precio,
                producto.cantidad,
                producto.subtotal
            ]
            tableCarrito.row.add(fila);
        });
        tableCarrito.draw();
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

    function validaImagen(id) {
        if ($('#' + id)[0].files.length) {
            $('#' + id).removeClass('border-danger');
            $("#invalid_" + id).html('');
            return 1;
        } else {
            return 1;
        }
    }
</script>