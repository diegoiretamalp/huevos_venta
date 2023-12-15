<!DOCTYPE html>
<html lang="en">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Mystic Dashboard</title>
    <!-- Iconic Fonts -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="<?= ASSETS_VENDOR ?>iconic-fonts\flat-icons\flaticon.css">
    <!-- Bootstrap core CSS -->
    <link href="<?= ASSETS_CSS ?>bootstrap.min.css" rel="stylesheet">
    <!-- jQuery UI -->
    <link href="<?= ASSETS_CSS ?>jquery-ui.min.css" rel="stylesheet">

    <!-- datatable -->
    <link href="<?= ASSETS_CSS ?>datatables.min.css" rel="stylesheet">

    <!-- Mystic styles -->
    <link href="<?= ASSETS_CSS ?>style.css" rel="stylesheet">
    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="32x32" href="..\..\favicon.ico">
    <!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css"> -->
    <link rel="stylesheet" href="/resources/demos/style.css">
    <!-- Fontawesome -->
    <link rel="stylesheet" href="<?= ASSETS_PLUGINS ?>fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="<?= ASSETS_CSS ?>select2.min.css">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css"> -->

    <link rel="stylesheet" href="<?= ASSETS_PLUGINS ?>daterangepicker/daterangepicker.css">
    <style>
        .body-content {
            margin: 0;
            padding: 0;
            padding-right: 0 !important;
            background-image: url(<?= ASSETS_IMG . 'background2.jpg' ?>);
            /* background-size: cover; */
            background-position: center;
        }

        /* Estilo para el contenedor del grupo de botones */
        .button-group2 {
            display: inline-block;
        }

        /* Estilo para cada botón dentro del grupo */
        .buttonSpecial {

            padding: 6px 12px;
            /* Puedes ajustar el padding según tus preferencias */
            font-size: 14px;
            /* Puedes ajustar el tamaño de fuente según tus preferencias */
            margin: 0;
            border: 1px solid #ccc;
            background-color: #f0f0f0;
            cursor: pointer;
            border-radius: 5px;
        }
    </style>

</head>

<body class="ms-body ms-primary-theme ms-has-quickbar">
    <!-- Preloader -->
    <!-- <div id="preloader-wrap">
        <div class="spinner spinner-8">
            <div class="ms-circle1 ms-child"></div>
            <div class="ms-circle2 ms-child"></div>
            <div class="ms-circle3 ms-child"></div>
            <div class="ms-circle4 ms-child"></div>
            <div class="ms-circle5 ms-child"></div>
            <div class="ms-circle6 ms-child"></div>
            <div class="ms-circle7 ms-child"></div>
            <div class="ms-circle8 ms-child"></div>
            <div class="ms-circle9 ms-child"></div>
            <div class="ms-circle10 ms-child"></div>
            <div class="ms-circle11 ms-child"></div>
            <div class="ms-circle12 ms-child"></div>
        </div>
    </div> -->

    <!-- Overlays -->
    <!-- <div class="ms-aside-overlay ms-overlay-left ms-toggler" data-target="#ms-side-nav" data-toggle="slideLeft"></div> -->
    <div class="ms-aside-overlay ms-overlay-right ms-toggler" data-target="#ms-recent-activity" data-toggle="slideRight"></div>

    <?php
    // echo  $this->include('layout/sidenav_view');
    ?>
    <!-- Main Content -->
    <main class="body-content">
        <?php
        echo  $this->include('layout/topnav_view');

        if (isset($main_view)) {
            echo  $this->include($main_view);
        }
        ?>



    </main>
    <style>
        #btnScrollToTop {
            display: none;
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px;
            font-size: 18px;
            cursor: pointer;
        }

        #btnScrollToTop:hover {
            background-color: #0056b3;
        }
    </style>
    <button onclick="scrollToTop()" id="btnScrollToTop" title="Volver al inicio">&#9650;</button>
    <script>
        // Mostrar u ocultar el botón dependiendo de la posición de desplazamiento
        window.onscroll = function() {
            scrollFunction();
        };

        function scrollFunction() {
            var btnScrollToTop = document.getElementById("btnScrollToTop");

            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                btnScrollToTop.style.display = "block";
            } else {
                btnScrollToTop.style.display = "none";
            }
        }

        // Animar el desplazamiento hacia arriba al hacer clic en el botón
        function scrollToTop() {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        }
    </script>
    <!-- SCRIPTS -->
    <!-- Global Required Scripts Start -->
    <script src="<?= ASSETS_JS ?>jquery-3.5.1.min.js"></script>
    <script src="<?= ASSETS_JS ?>popper.min.js"></script>
    <script src="<?= ASSETS_JS ?>bootstrap.min.js"></script>
    <script src="<?= ASSETS_JS ?>perfect-scrollbar.js"> </script>
    <script src="<?= ASSETS_JS ?>jquery-ui.min.js"> </script>
    <script src="<?= ASSETS_JS ?>datatables.min.js"> </script>

    <!-- Global Required Scripts End -->
    <!-- Mystic core JavaScript -->
    <script src="<?= ASSETS_JS ?>framework.js"></script>

    <!-- Settings -->
    <script src="<?= ASSETS_JS ?>settings.js"></script>


    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="<?= ASSETS_JS ?>select2.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script> -->
    <!-- <script src="<?= ASSETS_PLUGINS ?>moment/moment.min.js"></script>
    <script src="<?= ASSETS_PLUGINS ?>moment/moment-with-locales.js"></script>
    <script src="<?= ASSETS_PLUGINS ?>daterangepicker/daterangepicker.js"></script> -->
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
            })
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