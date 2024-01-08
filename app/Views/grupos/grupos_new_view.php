<?php
$session = session();
$errores = $session->getFlashdata('errores');

?>
<div class="ms-content-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb pl-0">
                        <li class="breadcrumb-item"><a href="<?= base_url('/') ?>"><i class="material-icons">home</i> Menu</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('grupos/listado') ?>">Listado de Grupos</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Nuevo Grupo</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-12 card card-body">
                <form action="<?= isset($action) ? $action : '' ?>" method="post" id="formulario">
                <input type="hidden" name="clientes_grupo" id="clientes_grupo">
                    <div class="form-row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8 mb-3">
                            <label for="nombre">Nombre</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese Nombre..." value="<?= !empty($errores) ? $errores['nombre'] : (!empty($post) ? $post['nombre'] : '') ?>">
                                <div id="invalid_nombre" class="valid-feedback">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-2"></div>
                        <div class="col-md-3 mb-3">
                            <div class="form-group">
                                <label for="comuna_id">Comuna</label>
                                <select name="comuna_id" id="comuna_id" class="form-control">
                                    <option value="">Seleccionar</option>
                                    <?php if (!empty($comunas)) : ?>
                                        <?php foreach ($comunas as $comuna) : ?>
                                            <option value="<?= $comuna->id ?>"><?= $comuna->nombre ?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                                <div id="invalid_comuna_id" class="text-danger">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="cliente_id">Cliente</label>
                            <div class="input-group">
                                <select name="cliente_id" id="cliente_id" class="form-control">
                                    <option value="" id="option_cero">Seleccionar</option>
                                    <?php if (!empty($clientes)) : ?>
                                        <?php foreach ($clientes as $cliente) : ?>
                                            <option comuna-data="<?= $cliente->comuna_id ?>" value="<?= $cliente->id ?>"><?= $cliente->nombre ?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                                <div id="invalid_cliente_id">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 mb-3 mt-2">
                            <button class="btn btn-info w-100" id="cargar_clientes" type="button">Cargar Clientes</button>
                        </div>
                    </div>

                    <div class="form-row w-100">
                        <div class="table-responsive">

                            <table class="table" id="table_clientes">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>NOMBRE CLIENTE</th>
                                        <th>DIRECCION</th>
                                        <th>CONTACTO</th>
                                        <th>ACCION</th>
                                    </tr>
                                </thead>
                                <tbody id="table_clientes_tbody">

                                </tbody>
                            </table>
                        </div>

                    </div>
                    <div class="text-right">
                        <a class="btn btn-info mt-4" href="<?= base_url('grupos/listado') ?>"><i class="fa fa-list-alt" aria-hidden="true"></i> Volver a Listado</a>
                        <button class="btn btn-success mt-4" type="button" id="btn_crear_grupo"><i class="fas fa-save"></i> Crear Grupo</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>