
<?php
$session = session();
$errores = $session->getFlashdata('errores');
//hola
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
                                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese Nombre..." value="<?= !empty($errores) ? $errores['nombre'] : (!empty($usuarios) ? $usuarios->nombre : '') ?>">
                                <div id="invalid_nombre" class="valid-feedback">
                                </div>
                            </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="rut">Rut</label>
                        <div class="input-group">
                                <input type="text" class="form-control" id="rut" name="rut" placeholder="Ingrese su R.U.T ..." value="<?= !empty($errores) ? $errores['rut'] : (!empty($usuarios) ? $usuarios->rut : '') ?>">
                                <div id="invalid_rut" class="valid-feedback">
                                </div>
                            </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-2 mb-3"></div>

                    <div class="col-md-4 mb-3">
                        <label for="celular">Celular</label>
                        <div class="input-group">
                                <input type="text" class="form-control" id="celular" name="celular" placeholder="Ingrese su número celular ej: 56987456124 ..." value="<?= !empty($errores) ? $errores['celuar'] : (!empty($usuarios) ? $usuarios->celular : '') ?>">
                                <div id="invalid_celular" class="valid-feedback">
                                </div>
                            </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="email">Email</label>
                        <div class="input-group">
                                <input type="text" class="form-control" id="email" name="email" placeholder="Ingrese su email ej: correo@gmail.com ..." value="<?= !empty($errores) ? $errores['email'] : (!empty($usuarios) ? $usuarios->email : '') ?>">
                                <div id="invalid_email" class="valid-feedback">
                                </div>
                            </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-2 mb-3"></div>

                    <div class="col-md-4 mb-3">
                        <label for="direccion">Direccion</label>
                        <div class="input-group">
                                <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Ingrese su direccion ..." value="<?= !empty($errores) ? $errores['email'] : (!empty($usuarios) ? $usuarios->direccion : '') ?>">
                                <div id="invalid_email" class="valid-feedback">
                                </div>
                            </div>
                    </div>
                    </div>
                        <div class="col-md-4 mb-4">
                            <label for="perfil_id">Perfil</label>
                            <div class="input-group">
                                <select name="perfil_id" id="perfil_id" class="form-control">
                                    <option value="">Seleccionar</option>
                                    <?php foreach ($perfiles as $perfil) : ?>
                                        <option <?= !empty($errores) ? ($errores['sector_id'] == $perfil->id ? 'selected' : '') : (!empty($perfil) ? ($perfil->id == $usuarios->perfil_id ? 'selected' : '') : '') ?> value="<?= $perfil->id ?>"><?= $perfil->nombre ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div id="invalid_comuna_id">
                                </div>
                            </div>
                        </div>     
                </div>

                <div class="form-row">

                    <div class="col-md-2 mb-3"></div>

                    <div class="col-md-4 mb-4">
                        <label for="estado">Estado</label>
                        <div class="input-group">
                            <select name="estado" id="estado" class="form-control">
                                <option value="0" <?= !empty($errores) ? ($errores['estado'] == '0' ? 'selected' : '') : (!empty($usuarios) ? ($usuarios->estado == '0' ? 'selected' : '') : '') ?>>Inactivo</option>
                                <option value="1" <?= !empty($errores) ? ($errores['estado'] == '1' ? 'selected' : '') : (!empty($usuarios) ? ($usuarios->estado == '1' ? 'selected' : '') : '') ?>>Activo</option>
                            </select>
                            <div id="invalid_estado">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="form-row">
                    <div class="col-2"></div>
                    <div class="col-8 text-right">
                        <a class="btn btn-secondary mt-4" href="<?= base_url('usuarios/listado') ?>"><i class="fa fa-list-alt" aria-hidden="true"></i> Volvera Listado</a>
                        <button class="btn btn-primary mt-4" type="submit"><i class="fas fa-save    "></i> Editar Usuario</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

