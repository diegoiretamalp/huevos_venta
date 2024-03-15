<script>
    $(document).ready(function() {
        // $('#data-table').DataTable();
    });

    function validaCampos(texto, id, tipo = 'texto_min', obligatorio = true, msg = "Campo Obligatorio") {
        const $campo = $('#' + id);

        const limpiarCampo = (color, mensaje) => {
            $campo.css('border-color', color + (color === 'green' ? ' !important' : ''));
            $("#invalid_" + id).text(mensaje);
            if (color == 'green') {
                return 1;
            } else {
                return 0;
            }
        };

        const campoValido = () => {
            return limpiarCampo('green', '');
        };

        const textoValido = (minLength, mensaje) => {
            texto = texto.trim();
            return texto.length >= minLength ? campoValido() : limpiarCampo('red', mensaje);
        };

        const validarNumero = () => {
            texto = formatNumber(texto);
            return texto !== '' ? campoValido() : limpiarCampo('red', msg);
        };

        const validarCelular = () => {
            $("#" + id).val(soloNumeros(texto));
            let cel = formatCelular(texto);
            return cel !== false ? campoValido() : limpiarCampo('red', 'N° Incorrecto. Ej: +569XXXXXXXX');
        };

        const validarRut = () => {
            let valRut = Rut(texto, id);
            return valRut !== false ? campoValido() : limpiarCampo('red', 'Rut incorrecto. Ej: 12.345.678-9');
        }

        // Agrega más funciones de validación según sea necesario

        if ($campo.length) {
            if (texto !== '') {
                switch (tipo) {
                    case 'text_min2':
                    case 'texto_min':
                        return textoValido(2, 'El largo Mínimo de 2 Caracteres');
                        break;

                    case 'texto_min_descripcion':
                        return textoValido(3, 'El largo Mínimo de 3 Caracteres');
                        break;

                    case 'moneda':
                        return textoValido(2, 'El valor mínimo debe ser 0');
                        break;

                    case 'numero':
                        return validarNumero();
                        break;

                    case 'celular':
                        return validarCelular();
                        break;
                    case 'rut':
                        return validarRut();
                        break;

                    case 'select':
                        if (texto > 0) {
                            return campoValido();
                        } else {
                            return limpiarCampo('red', msg);
                        }
                        break;
                    case 'select2text':
                        if (texto !== '') {
                            return campoValido();
                        } else {
                            return limpiarCampo('red', msg);
                        }
                        break;
                    case 'checkbox':
                        let respuesta = cuentaCheckbox(1, msg);
                        return respuesta;
                        break;
                    case 'email':
                        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                        return emailRegex.test(texto) ? campoValido() : limpiarCampo('red', 'Correo electrónico inválido');
                        break;

                    case 'password':
                        // Validar la fortaleza de la contraseña según tus criterios
                        return texto.length > 4 ? campoValido() : limpiarCampo('red', 'La contraseña debe tener más de 4 caracteres');
                        break;
                    case 'password_confirm':
                        // Validar la fortaleza de la contraseña según tus criterios
                        var password = $('#password').val();
                        if(texto.length > 4 ){
                            if(texto === password ){
                                return campoValido()
                            }else{
                                return limpiarCampo('red', 'La contraseñas no coinciden.')
                            }
                        }else{
                            return limpiarCampo('red', 'La contraseña debe tener más de 4 caracteres')
                        }
                        break;


                    case 'fecha':
                        // Utiliza una expresión regular para validar el formato de fecha (ejemplo: yyyy/mm/dd)
                        const fechaRegex = /^\d{4}-\d{2}-\d{2}$/;
                        // const fechaRegex = /^\d{4}\/\d{2}\/\d{2}$/;
                        console.log('FECHA');
                        console.log(texto);
                        console.log('FECHA');
                        if (fechaRegex.test(texto)) {
                            return campoValido();
                        } else {
                            return limpiarCampo('red', 'Formato de fecha inválido (yyyy/mm/dd)');
                        }
                        break;


                    case 'url':
                        // Puedes utilizar una expresión regular para validar el formato de URL
                        const urlRegex = /^(http|https):\/\/[\w\-]+(\.[\w\-]+)+([\w\-\.,@?^=%&:/~\+#]*[\w\-\@?^=%&/~\+#])?$/;
                        return urlRegex.test(texto) ? campoValido() : limpiarCampo('red', 'URL inválida');
                        break;

                    case 'hora':
                        // Puedes utilizar una expresión regular para validar el formato de hora (ejemplo: hh:mm)
                        const horaRegex = /^(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/;
                        return horaRegex.test(texto) ? campoValido() : limpiarCampo('red', 'Formato de hora inválido (hh:mm)');
                        break;

                    case 'color':
                        // Puedes utilizar una expresión regular para validar el formato de color hexadecimal
                        const colorRegex = /^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/;
                        return colorRegex.test(texto) ? campoValido() : limpiarCampo('red', 'Formato de color inválido');
                        break;

                    default:
                        return textoValido(1, msg);
                }
            } else {
                return (obligatorio == false) ? campoValido() : limpiarCampo('red', msg);
            }
        } else {
            toastr["error"](`No existe ID de Campo ${id}`, "Error de Validación");
            return 0;
        }
    }


    function formatNumber(costo) {
        costo = costo.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ".")
        costo = "" + costo;
        return costo;
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
        toastr[type](msg, title);
    }
</script>