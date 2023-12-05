<script>
    $(document).ready(function() {
        $('#nombre').keyup(function() {
            validaCampos($('#nombre').val(), 'nombre', 'text_min', true);
        });
        $('#rut_factura').keyup(function() {
            validaCampos($('#rut_factura').val(), 'rut_factura', 'rut', true);
        });
        $("#btn_submit").click(function() {
            // let rut_factura = $("#rut_factura").val();

            let nombre_val = validaCampos($('#nombre').val(), 'nombre', 'text_min', true);
            let rut_factura_val = validaCampos($('#rut_factura').val(), 'rut_factura', 'rut', true);;

            if (rut_factura_val == 1 && nombre_val == 1) {
                $("#formulario").submit();
            } else {
                toastr["error"](`Se encontraron 1 o más Campos con Problemas. Corrija e Intente nuevamente`, "Error de Validación")
            }
        });
    })
</script>