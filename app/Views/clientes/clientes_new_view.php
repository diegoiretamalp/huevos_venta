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
                    <li class="breadcrumb-item"><a href="<?= base_url('clientes/listado') ?>">Clientes</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Nuevo Cliente</li>
                </ol>
            </nav>
        </div>
        <div class="col-12">
            <div class="card card-body">
                <form action="<?= isset($action) ? $action : '' ?>" method="post" id="formulario">
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label for="nombre">Nombre Completo</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese Nombre..." value="<?= !empty($errores) ? $errores['nombre'] : (!empty($post) ? $post['nombre'] : '') ?>">
                                <div id="invalid_nombre" class="valid-feedback">
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-md-4 mb-3">
                            <label for="apellido_paterno">Apellido Paterno</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="apellido_paterno" name="apellido_paterno" placeholder="Ingrese Apellido Paterno..." value="<?= !empty($errores) ? $errores['apellido_paterno'] : (!empty($post) ? $post['apellido_paterno'] : '') ?>">
                                <div id="invalid_apellido_paterno">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="apellido_materno">Apellido Materno</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="apellido_materno" name="apellido_materno" placeholder="Ingrese Apellido Materno..." value="<?= !empty($errores) ? $errores['apellido_materno'] : (!empty($post) ? $post['apellido_materno'] : '') ?>">
                                <div id="invalid_apellido_materno">
                                </div>
                            </div>
                        </div> -->
                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label for="rut_factura">Rut a Facturar</label>
                                <input type="text" class="form-control" id="rut_factura" name="rut_factura" placeholder="Ingrese Rut a Facturar..." value="<?= !empty($errores) ? $errores['rut_factura'] : (!empty($post) ? $post['rut_factura'] : '') ?>">
                                <div id="invalid_rut_factura" class="text-danger">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <label for="nombre_negocio">Nombre del negocio</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="nombre_negocio" name="nombre_negocio" placeholder="Ingrese nombre del negocio..." value="<?= !empty($errores) ? $errores['nombre_negocio'] : (!empty($cliente) ? $cliente->nombre_negocio : '') ?>">
                                <div id="invalid_nombre_negocio">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        
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
                        <div class="col-xl-4">
                            <label for="comuna_id">Comuna</label>
                            <select class="form-control" name="comuna_id" id="comuna_id">
                                <option value="0">Todas</option>
                                <?php if (!empty($comunas)) : ?>
                                    <?php foreach ($comunas as $comuna) : ?>
                                        <option region-data=<?= $comuna->region_id ?> value="<?= $comuna->id ?>"><?= $comuna->nombre ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                        <div class="col-xl-4">
                            <label for="sector_id">Sector</label>
                            <select class="form-control" name="sector_id" id="sector_id">
                                <option value="0">Todas</option>
                                <?php if (!empty($sectores)) : ?>
                                    <?php foreach ($sectores as $sector) : ?>
                                        <option comuna-data=<?= $sector->comuna_id ?> value="<?= $sector->id ?>"><?= $sector->nombre ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                        
                        <div class="col-md-4 mb-4">
                            <label for="direccion">Direccion</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Ingrese Direccion..." value="<?= !empty($errores) ? $errores['direccion'] : (!empty($cliente) ? $cliente->direccion : '') ?>">
                                <div id="invalid_direccion">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-4 mb-4">
                            <label for="producto_id">Producto</label>
                            <div class="input-group">
                                <select name="producto_id" id="producto_id" class="form-control">
                                    <option value="0">Seleccionar</option>
                                    <?php foreach ($productos as $producto) : ?>
                                        <option <?= !empty($errores) ? ($errores['producto_id'] == $producto->id ? 'selected' : '') : (!empty($post) ? ($post['producto_id'] == $producto->id ? 'selected' : '') : '') ?> value="<?= $producto->id ?>"><?= $producto->nombre ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div id="invalid_sector_id">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <label for="tipo_huevo">Tipo</label>
                            <div class="input-group">
                                <select name="tipo_huevo" id="tipo_huevo" class="form-control">
                                    <option value="c">Color</option>
                                    <option value="b">Blanco</option>
                                </select>
                                <div id="invalid_tipo_huevo">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <label for="precio">Precio</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="precio_favorito" name="precio_favorito" placeholder="Ingrese Precio..." value="<?= !empty($errores) ? $errores['precio_favorito'] : (!empty($cliente) ? $cliente->precio_favorito : '') ?>">
                                <div id="invalid_precio">
                                </div>
                            </div>
                        </div>

                    </div>
                    <button class="btn btn-primary mt-4 d-block w-100" type="button" id="btn_submit">Crear Cliente</button>
                </form>
            </div>
        </div>
    </div>
</div>