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
                <form action="<?= isset($action) ? $action : '' ?>" method="post">
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label for="nombre">Nombres</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese Nombre..." value="<?= !empty($errores) ? $errores['nombre'] : (!empty($cliente) ? $cliente->nombre : '') ?>">
                                <div id="invalid_nombre" class="valid-feedback">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="apellido_paterno">Apellido Paterno</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="apellido_paterno" name="apellido_paterno" placeholder="Ingrese Apellido Paterno..." value="<?= !empty($errores) ? $errores['nombre'] : (!empty($cliente) ? $cliente->apellido_paterno : '') ?>">
                                <div id="invalid_apellido_paterno">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="apellido_materno">Apellido Materno</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="apellido_materno" name="apellido_materno" placeholder="Ingrese Apellido Materno..." value="<?= !empty($errores) ? $errores['nombre'] : (!empty($cliente) ? $cliente->apellido_materno : '') ?>">
                                <div id="invalid_apellido_materno">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label for="rut_factura">Rut a Facturar</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="rut_factura" name="rut_factura" placeholder="Ingrese Rut a Facturar..." value="<?= !empty($errores) ? $errores['rut_factura'] : (!empty($cliente) ? $cliente->rut_factura : '') ?>">
                                <div id="invalid_rut_factura">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="celular">Celular</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="celular" id="celular" placeholder="Ingrese Celular..." value="<?= !empty($errores) ? $errores['celular'] : (!empty($cliente) ? $cliente->celular : '') ?>">
                                <div id="invalid_celular">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="email">Email</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="email" id="email" placeholder="Ingrese Email..." value="<?= !empty($errores) ? $errores['email'] : (!empty($cliente) ? $cliente->email : '') ?>">
                                <div id="invalid_email">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-4 mb-4">
                            <label for="sector_id">Sector</label>
                            <div class="input-group">
                                <select name="sector_id" id="sector_id" class="form-control">
                                    <option value="">Seleccionar</option>
                                    <?php foreach ($sectores as $sector) : ?>
                                        <option <?= !empty($errores) ? ($errores['sector_id'] == $sector->id ? 'selected' : '') : (!empty($sector) ? ($sector->id == $cliente->sector_id ? 'selected' : '') : '') ?> value="<?= $sector->id ?>"><?= $sector->nombre ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div id="invalid_comuna_id">
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
                        <div class="col-md-4 mb-3">
                            <label for="direccion">Direccion</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Ingrese Link..." value="<?= !empty($errores) ? $errores['direccion'] : (!empty($cliente) ? $cliente->direccion : '') ?>">
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
                                        <option <?= !empty($errores) ? ($errores['producto_id'] == $producto->id ? 'selected' : '') : (!empty($producto) ? ($producto->id  == $cliente->producto_id ? 'selected' : '') : '') ?> value="<?= $producto->id ?>"><?= $producto->nombre ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div id="invalid_producto_id">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <label for="tipo_huevo">Tipo</label>
                            <div class="input-group">
                                <select name="tipo_huevo" id="tipo_huevo" class="form-control">
                                    <option <?= (!empty($cliente->tipo_huevo) ? ($cliente->tipo_huevo  == 'c' ? 'selected' : '') : '') ?> value="c">Color</option>
                                    <option <?= (!empty($cliente->tipo_huevo) ? ($cliente->tipo_huevo  == 'b' ? 'selected' : '') : '') ?> value="b">Blanco</option>
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
                    <div class="form-row">
                        <div class="col-md-4 mb-4">
                            <div class="form-group">
                                <label for="estado">Estado</label>
                                <select name="estado" id="estado" class="form-control">
                                    <option value="1" <?= $cliente->estado == true ? 'selected' : '' ?>>Activo</option>
                                    <option value="0" <?= $cliente->estado == false ? 'selected' : '' ?>>Inactivo</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary mt-4 d-block w-100" type="submit">Editar Cliente</button>
                </form>
            </div>
        </div>
    </div>
</div>