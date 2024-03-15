<script>
    $(document).ready(function() {
        $('#rut').keyup(function() {
            validaCampos($('#rut').val(), 'rut');
        });
        $('#password').keyup(function() {
            validaCampos($('#password').val(), 'password');
        });

        function validaCampos(texto, id, msg = 'Campo Obligatorio') {
            if ($("#" + id)) {
                if (texto !== '') {

                    if (id == 'password') {
                        texto = texto.trim();
                        if (texto.length < 4) {
                            $("#" + id).css('border-color', 'red');
                            $("#invalid_" + id).text('El largo Mínimo de 4 Caracteres');
                            return 0;
                        } else {
                            $("#" + id).css('border-color', 'green');
                            $("#invalid_" + id).text('');
                        }
                    } else {
                        if (id == 'rut') {
                            let valRut = Rut(texto, id);
                            if (valRut == false) {
                                $("#" + id).css('border-color', 'red');
                                $("#invalid_" + id).text('Rut Inválido');
                                return 0;
                            } else {
                                $("#" + id).css('border-color', 'green');
                                $("#invalid_" + id).text('');
                            }
                        } else {
                            $("#" + id).css('border-color', 'green');
                            $("#invalid_" + id).text('');
                            return 1;
                        }
                    }
                    return 1;
                } else {
                    $("#" + id).css('border-color', 'red');
                    $("#invalid_" + id).text(msg);
                    return 0;
                }
            }
        }


        $("#iniciar_sesion").click(function() {
            let rut = $("#rut").val();
            let password = $("#password").val();
            console.log(rut);
            console.log(password);

            let rut_val = validaCampos(rut, 'rut');
            let password_val = validaCampos(password, 'password');

            if (rut_val == 1 && password_val == 1) {
                //cargando();
                $("#formulario").submit();
            } else {
                toastr.options = {
                    "closeButton": true,
                    "progressBar": true,
                }
                toastr["error"](`Se encontraron 1 o más Campos con Problemas. Corrija e Intente nuevamente`, "Error de Validación")
            }
        });

        $('#restablecer').click(function(){
            let rut = validaCampos($('#rut').val(), 'rut');
            if(rut == 1){
                $('#formulario_restablecer').submit();
            }else{
                toastr["error"](`Ingrese un rut válido para continuar`, "Error de Validación")
            }
        });
    });
</script>