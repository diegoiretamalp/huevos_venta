<div class="ms-content-wrapper">
    <!--------breadcrumb-------->

    <div class="row">
        <div class="col-md-12 col-xl-6">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb pl-0">
                    <li class="breadcrumb-item"><a href="<?= base_url('/') ?>"><i class="material-icons">home</i> Menu</a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url('rutas/listado') ?>">Listado Rutas</a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url('rutas/ver/'. $ruta_id) ?>">Ver Ruta</a></li>
                    <li class="breadcrumb-item"><a href="#">Cerrar Ruta</a></li>
                </ol>
            </nav>
        </div>
        <div class="col-md-12 col-xl-6 d-flex justify-content-end">
            <a class="btn btn-pill btn-info has-icon d-flex align-items-center" href="<?= base_url('rutas/nueva') ?>">
                <i class="fas fa-user-circle" style="font-size: 24px;"></i>
                Nueva Ruta
            </a>
        </div>
    </div>
    <br>

    <!--------breadcrumb-------->
    <div class="row">
        <div class="col-12">
            <div class="ms-card">
                <div class="ms-card-body">
                    
                </div>
            </div>
        </div>
    </div>
</div>