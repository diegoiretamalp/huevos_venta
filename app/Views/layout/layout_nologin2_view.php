<!--
=========================================================
* Material Dashboard 2 - v3.0.0
=========================================================

* Product Page: https://www.creative-tim.com/product/material-dashboard
* Copyright 2021 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="<?= ASSETS ?>assets2/img/apple-icon.png">
    <link rel="icon" type="image/png" href="<?= ASSETS ?>assets2/img/favicon.png">
    <title>
        Material Dashboard 2 by Creative Tim
    </title>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Nucleo Icons -->
    <link href="<?= ASSETS ?>assets2/css/nucleo-icons.css" rel="stylesheet" />
    <link href="<?= ASSETS ?>assets2/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- CSS Files -->
    <link id="pagestyle" href="<?= ASSETS ?>assets2/css/material-dashboard.css?v=3.0.0" rel="stylesheet" />
</head>

<body class="bg-gray-200">

    <?php

    if (isset($main_view)) {
        echo  $this->include($main_view);
    }
    ?>

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <!--   Core JS Files   -->
    <script src="<?= ASSETS_JS ?>jquery-3.5.1.min.js"></script>
    <script src="<?= ASSETS ?>assets2/js/core/popper.min.js"></script>
    <script src="<?= ASSETS ?>assets2/js/core/bootstrap.min.js"></script>
    <script src="<?= ASSETS ?>assets2/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="<?= ASSETS ?>assets2/js/plugins/smooth-scrollbar.min.js"></script>
    <script src="<?= ASSETS_JS ?>jquery-ui.min.js"> </script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="<?= ASSETS ?>assets2/js/material-dashboard.min.js?v=3.0.0"></script>


    <!-- <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script> -->
    <!-- Github buttons -->
    <!-- <script async defer src="https://buttons.github.io/buttons.js"></script> -->
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->


    <script>
        function cargando(msg = 'Cargando...', tiempo = 10000000000) {
            Swal.fire({
                title: `${msg}`,
                html: `No cierre ni actualice la página`,
                allowOutsideClick: false,
                allowEscapeKey: false,
                timer: tiempo,
                didOpen: () => {
                    Swal.showLoading()
                }
            });
        }



        toastr.options = {
            "closeButton": true,
            "progressBar": true,
        }
        <?php $session = session(); ?>
        <?php if ($session->getFlashdata("success")) : ?>
            toastr["success"](`<?= $session->getFlashdata("success"); ?>`, "<?= $session->getFlashdata("success_title"); ?>")
        <?php endif; ?>
        <?php if ($session->getFlashdata("warning")) : ?>
            toastr["warning"](`<?= $session->getFlashdata("warning"); ?>`, "<?= $session->getFlashdata("warning_title"); ?>")
        <?php endif; ?>
        <?php if ($session->getFlashdata("error")) : ?>
            toastr["error"](`<?= $session->getFlashdata("error"); ?>`, "<?= $session->getFlashdata("error_title"); ?>")
        <?php endif; ?>
    </script>

    <?php
    if (isset($js_content)) {
        foreach ($js_content as $js) {
            echo  $this->include($js);
        }
    }
    ?>
</body>

</html>