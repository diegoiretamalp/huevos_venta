<script>
    $(document).ready(function() {
        $('#rut').keyup(function() {
            validaCampos($('#rut').val(), 'rut', 'rut', true);
        });
        $('#razon_social').keyup(function() {
            validaCampos($('#razon_social').val(), 'razon_social', 'texto_min', true);
        });
        $('#email').keyup(function() {
            validaCampos($('#email').val(), 'email', 'email', true);
        });
        $('#password').keyup(function() {
            validaCampos($('#password').val(), 'password', 'password', true);
        });
        $('#password_confirm').keyup(function() {
            validaCampos($('#password_confirm').val(), 'password_confirm', 'password_confirm', true);
        });

        $("#registrarse").click(function() {
            let rut = validaCampos($('#rut').val(), 'rut', 'rut', true);
            let razon_social = validaCampos($('#razon_social').val(), 'razon_social', 'texto_min', true);
            let email = validaCampos($('#email').val(), 'email', 'email', true);
            let password = validaCampos($('#password').val(), 'password', 'password', true);
            let password_confirm = validaCampos($('#password_confirm').val(), 'password_confirm', 'password', true);
            let terminos_condiciones = $('#terminos_condiciones').prop('checked');

            if (rut == 1 && razon_social == 1 && email == 1 && password == 1 && password_confirm == 1) {
                if (terminos_condiciones == true) {
                    $("#formulario").submit();
                } else {
                    toastr["error"](`Debes aceptar los Términos y Condiciones para continuar por favor...`, "Error de Validación")
                }
            } else {
                toastr.options = {
                    "closeButton": true,
                    "progressBar": true,
                }
                toastr["error"](`Se encontraron 1 o más Campos con Problemas. Corrija e Intente nuevamente`, "Error de Validación")
            }
        });

        $('#restablecer').click(function() {
            let rut = validaCampos($('#rut').val(), 'rut');
            if (rut == 1) {
                $('#formulario_restablecer').submit();
            } else {
                toastr["error"](`Ingrese un rut válido para continuar`, "Error de Validación")
            }
        });
    });
</script>