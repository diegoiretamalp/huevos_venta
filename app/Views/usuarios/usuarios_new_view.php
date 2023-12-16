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
                    <li class="breadcrumb-item"><a href="<?= base_url('usuarios/listado') ?>">Usuarios</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Nuevo Usuario</li>
                </ol>
            </nav>
        </div>
        <div class="col-12 card card-body">
            <form action="<?= isset($action) ? $action : '' ?>" method="post">
                <div class="form-row">
                    <div class="col-md-2 mb-3"></div>
                    <div class="col-md-4 mb-3">
                        <label for="nombre">Nombre</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese Nombre..." value="<?= !empty($errores) ? $errores['nombre'] : (!empty($post) ? $post['nombre'] : '') ?>">
                            <div id="invalid_nombre" class="valid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="rut">Rut</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="rut" name="rut" placeholder="Ingrese Rut..." value="<?= !empty($errores) ? $errores['rut'] : (!empty($post) ? $post['rut'] : '') ?>">
                            <div id="invalid_rut">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-2 mb-3"></div>

                    <div class="col-md-4 mb-3">
                        <label for="celular">Celular</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="celular" id="celular" placeholder="Ingrese Celular..." value="<?= !empty($errores) ? $errores['celular'] : (!empty($post) ? $post['celular'] : '') ?>">
                            <div id="invalid_celular">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="email">Email</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="email" id="email" placeholder="Ingrese Email..." value="<?= !empty($errores) ? $errores['email'] : (!empty($post) ? $post['email'] : '') ?>">
                            <div id="invalid_email">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-2 mb-3"></div>

                    <div class="col-md-4 mb-3">
                        <label for="direccion">Direccion</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Ingrese Direccion..." value="<?= !empty($errores) ? $errores['direccion'] : (!empty($post) ? $post['direccion'] : '') ?>">
                            <div id="invalid_direccion">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="perfil_id">Perfil</label>
                        <div class="input-group">
                            <select name="perfil_id" id="perfil_id" class="form-control">
                                <?php foreach ($perfiles as $perfil) : ?>
                                    <option <?= !empty($errores) ? ($errores['perfil_id'] == $perfil->id ? 'selected' : '') : '' ?> value="<?= $perfil->id ?>"><?= $perfil->nombre ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div id="invalid_perfil_id">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-2 text-right"></div>
                    <div class="col-8 text-right">
                        <a href="<?= base_url('usuarios/listado') ?>" class="btn btn-secondary mt-4"><i class="fa fa-list-alt" aria-hidden="true"></i> Volver a Listado</a>
                        <button class="btn btn-primary mt-4" type="submit"><i class="fas fa-save    "></i> Crear Usuario</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


