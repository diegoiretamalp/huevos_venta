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
                    <li class="breadcrumb-item"><a href="<?= base_url('productos/listado') ?>">Productos</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Nuevo Producto</li>
                </ol>
            </nav>
        </div>
        <div class="col-12">
            <form action="<?= isset($action) ? $action : '' ?>" method="post">
                <div class="form-row">
                    <div class="col-md-2"></div>
                    <div class="col-md-4 mb-3">
                        <label for="nombre">Nombre</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese Nombre..." value="<?= !empty($errores) ? $errores['nombre'] : (!empty($post) ? $post['nombre'] : '') ?>">
                            <div id="invalid_nombre" class="valid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="apellido_paterno">Descripcion</label>
                        <div class="input-group">
                            <textarea class="form-control" name="descripcion" id="descripcion"><?= !empty($errores) ? $errores['descripcion'] : (!empty($post) ? $post['descripcion'] : '') ?></textarea>
                            <div id="invalid_descripcion">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-2"></div>
                    <div class="col-md-4 mb-3">
                        <label for="stock">Stock</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="stock" name="stock" placeholder="Ingrese Stock..." value="<?= !empty($errores) ? $errores['stock'] : (!empty($post) ? $post['stock'] : '') ?>">
                            <div id="invalid_stock">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="precio">Precio</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="precio" id="precio" placeholder="Ingrese Precio..." value="<?= !empty($errores) ? $errores['precio'] : (!empty($post) ? $post['celular'] : '') ?>">
                            <div id="invalid_precio">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-2"></div>
                    <div class="col-md-4 mb-3">
                        <label for="categoria_id">Categoria</label>
                        <div class="input-group">
                            <select name="categoria_id" id="categoria_id" class="form-control">
                                <option value="">Seleccionar</option>
                                <option value="1">Primera</option>
                                <option value="2">Segunda</option>
                                <option value="3">Extra</option>
                                <option value="4">Super Extra</option>
                            </select>
                            <div id="invalid_categoria_id">
                            </div>
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary mt-4 d-block w-100" type="submit">Crear Producto</button>
            </form>
        </div>
    </div>
</div>