<script>
    $(document).ready(function() {
        $('#data-table').DataTable();
    });

    function validaCampos(texto, id, tipo = 'texto', obligatorio = true, msg = "Campo Obligatorio") {

        if ($('#' + id)) {

            if (texto !== '') {

                switch (tipo) {
                    case 'text_min2':
                        texto = texto.trim();
                        if (texto.length < 2) {
                            $("#" + id).css('border-color', 'red');
                            $("#invalid_" + id).text('El largo Mínimo de 2 Caracteres');
                            return 0;
                        } else {
                            $("#" + id).css('border-color', 'green');
                            $("#invalid_" + id).text('');
                            return 1;
                        }
                        break;
                    case 'texto_min':
                        texto = texto.trim();
                        if (texto.length < 2) {
                            $("#" + id).css('border-color', 'red');
                            $("#invalid_" + id).text('El largo Mínimo de 2 Caracteres');
                            return 0;
                        } else {
                            $("#" + id).css('border-color', 'green');
                            $("#invalid_" + id).text('');
                            return 1;
                        }
                        break;
                    case 'texto_min_descripcion':
                        texto = texto.trim();
                        if (texto.length < 3) {
                            $("#" + id).css('border-color', 'red');
                            $("#invalid_" + id).html('El largo Mínimo de 3 Caracteres');
                            return 0;
                        } else {
                            $("#" + id).css('border-color', 'green');
                            $("#invalid_" + id).html('');
                            return 1;
                        }
                        break;
                    case 'moneda':
                        texto = texto.trim();
                        if (texto.length < 2) {
                            $("#" + id).css('border-color', 'red');
                            $("#invalid_" + id).text('El valor mínimo debe ser 0');
                            return 0;
                        } else {
                            $("#" + id).css('border-color', 'green');
                            $("#invalid_" + id).text('');
                            return 1;
                        }
                        break;
                    case 'numero':
                        texto = formatNumber(texto)
                        if (texto != '') {
                            $("#" + id).css('border-color', 'green');
                            $("#invalid_" + id).text('');
                            return 1;
                        } else {
                            $("#" + id).css('border-color', 'red');
                            $("#invalid_" + id).text(msg);
                            return 0;
                        }
                        break;
                    case 'celular':
                        $("#" + id).val(soloNumeros(texto))
                        let cel = formatCelular(texto);
                        if (cel == false) {
                            $("#" + id).css('border-color', 'red');
                            $("#invalid_" + id).text('N° Incorrecto. Ej: +569XXXXXXXX');
                            return 0;
                        } else {
                            $("#" + id).css('border-color', 'green');
                            $("#invalid_" + id).text('');
                            return 1;
                        }
                        break;

                    case 'telefono':
                        $("#" + id).val(soloNumeros(texto))
                        if (texto.length == 7) {
                            $("#" + id).css('border-color', 'green');
                            $("#invalid_" + id).text('');
                            return 1;
                        } else {
                            $("#" + id).css('border-color', 'red');
                            $("#invalid_" + id).text('N° Incorrecto. Ej: 531XXXX');
                            return 0;
                        }
                        break;
                    case 'rut':
                        let valRut = Rut(texto, id);
                        if (valRut == false) {
                            $("#" + id).css('border-color', 'red');
                            $("#invalid_" + id).text('Formato de Rut Inválido');
                            return 0;
                        } else {
                            texto = texto.replace('.', '')
                            texto = texto.replace('-', '')
                            if (texto == '111111111' || texto == '222222222' || texto == '333333333' || texto == '444444444' || texto == '555555555' || texto == '666666666' || texto == '777777777' || texto == '888888888' || texto == '999999999') {
                                $("#" + id).css('border-color', 'red');
                                $("#invalid_" + id).text('Rut Inválido');
                                return 0;
                            } else {
                                $("#" + id).css('border-color', 'green');
                                $("#invalid_" + id).text('');
                                return 1;
                            }
                        }
                        break;
                    case 'estado':

                        if (texto == '1' || texto == '0' || texto == 1 || texto == 0) {
                            $("#" + id).css('border-color', 'green');
                            $("#invalid_" + id).text('');
                            return 1;
                        } else {
                            $('#' + id).css('border-color', 'red');
                            $('#invalid_' + id).text('Seleccione opción Válida');
                            return 0;
                        }
                        break;
                    case 'select':
                        if (texto > 0) {
                            $("#" + id).css('border-color', 'green');
                            $("#invalid_" + id).text('');
                            return 1;
                        } else {
                            $("#" + id).css('border-color', 'red');
                            $("#invalid_" + id).text(msg);
                            return 0;
                        }
                        break;
                    case 'select2text':
                        if (texto != '') {
                            $("#" + id).css('border-color', 'green');
                            $("#invalid_" + id).text('');
                            return 1;
                        } else {
                            $("#" + id).css('border-color', 'red');
                            $("#invalid_" + id).text(msg);
                            return 0;
                        }
                        break;
                    case 'checkbox':
                        let respuesta = cuentaCheckbox(1, msg);
                        return respuesta
                        break;
                    default:
                        texto = texto.trim();
                        if (texto.length > 0) {
                            $("#" + id).css('border-color', 'green');
                            $("#invalid_" + id).text('');
                            return 1;
                        } else {
                            $("#" + id).css('border-color', 'red');
                            $("#invalid_" + id).text(msg);
                            return 0;
                        }
                        break;
                }

            } else {
                if (obligatorio == false) {
                    $("#" + id).css('border-color', '');
                    $("#invalid_" + id).text('');
                    return 1;
                } else {
                    $("#" + id).css('border-color', 'red');
                    $("#invalid_" + id).text(msg);
                    return 0;
                }
            }
        } else {
            toastr["error"](`No existe ID de Campo ${id}`, "Error de Validación")
            return 0;
        }



    }

    function formatCelular(phone) {
        phone = phone.split(' ').join('');
        if (!(/\+569\d{8}/.test(phone))) {
            return false
        }
        return true;
    }

    function checkNumero(numero) {
        if (numero.length == 0) {
            return numero;
        } else if (numero.length < 4) {
            numero = '+569';
        }

        let string = numero;
        if (!~string.indexOf("+569")) {
            string = "+569" + string;
        }
        numero = string;
        return numero;
    }

    function ordenarFechaHoraHumano(date) {
        var parts = date.split(" ");

        // Formatear la fecha
        var fecha = parts[0].split("-").reverse().join('-');

        // Formatear el tiempo
        var tiempo = parts[1].split(":").slice(0, 2).join(':');

        // Combinar fecha y tiempo
        var resultado = fecha + ' ' + tiempo;

        return resultado;
    }

    function formatearNumero(numero) {
        if (numero !== null && numero !== undefined && numero !== '') {
            var pesos = '$ ' + parseFloat(numero).toLocaleString('es-CL', {
                minimumFractionDigits: 0,
                maximumFractionDigits: 0
            });
        } else {
            var pesos = "No aplica";
        }
        return pesos;
    }
</script>

<script>
    function GetDataAjax(url, method, data = []) {
        console.log('siu');
        return $.ajax({
            url: url,
            method: method,
            dataType: 'json',
            success: function(resp) {
                let respuesta = JSON.stringify(resp);
                let obj = $.parseJSON(respuesta);

                if (obj['tipo'] !== 'success') {
                    toastr[obj['tipo']](obj['msg'], obj['title']);
                    throw new Error('Error en la respuesta del servidor');
                }
                //console.log(obj);
                return obj['data'];
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error en la petición AJAX:', textStatus, errorThrown);
                throw new Error('Error en la petición AJAX');

            }
        });
    }

    function PostDataAjax(url, method, data = []) {

        return $.ajax({
            url: url,
            method: method,
            dataType: 'json',
            data: data,
            success: function(resp) {
                let respuesta = JSON.stringify(resp);
                let obj = $.parseJSON(respuesta);

                if (obj['tipo'] !== 'success') {
                    toastr[obj['tipo']](obj['msg'], obj['title']);
                    throw new Error('Error en la respuesta del servidor');
                }
                return obj['data'];
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error en la petición AJAX:', textStatus, errorThrown);
                throw new Error('Error en la petición AJAX');

            }
        });
    }

    function ToastMsg(type, title, msg) {
        toastr[type][msg][title];
    }
</script>