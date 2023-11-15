<script>
    $(document).ready(function() {
        $('#fecha_ruta').val('<?= !empty($post['fecha_ruta']) ?  format_datepicket($post['fecha_ruta']) : format_datepicket(getDateToday()) ?>')
        $('#fecha_rutadate').keydown(function(event) {
            event.preventDefault();
        })
    });
</script>