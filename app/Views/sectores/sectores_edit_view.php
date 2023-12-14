<?php
$session = session();
$errores = $session->getFlashdata('errores');

?>
<div class="ms-content-wrapper">
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb pl-0">
                    <li class="breadcrumb-item"><a href="<?= base_url('/') ?>"><i class="material-icons">home</i> Menu</a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url('sectores/listado') ?>">Sectores</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Editar Sector</li>
                </ol>
            </nav>
        </div>
        <div class="col-12">
            <div class="card card-body">
                <form action="<?= isset($action) ? $action : '' ?>" method="post">
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="nombre">Nombre</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese Nombre..." value="<?= !empty($errores) ? $errores['nombre'] : (!empty($sector) ? $sector->nombre : '') ?>">
                                <div id="invalid_nombre" class="valid-feedback">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="comuna_id">Comuna</label>
                            <div class="input-group">
                                <select name="comuna_id" id="comuna_id" class="form-control">
                                    <option value="">Seleccionar</option>
                                    <?php foreach ($comunas as $comuna) : ?>
                                        <option <?= $comuna->id == $sector->comuna_id ? 'selected' : '' ?> value="<?= $comuna->id ?>"><?= $comuna->nombre ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div id="invalid_comuna_id">
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="<?= base_url('sectores/listado') ?>" class="btn btn-secondary mt-4"><i class="fa fa-arrow-left"></i>  Volver a Listado</a>
                    <button class="btn btn-success mt-4" type="submit"> <i class="fas fa-save"></i> Editar Sector</button>
                </form>
            </div>
        </div>
    </div>
</div>