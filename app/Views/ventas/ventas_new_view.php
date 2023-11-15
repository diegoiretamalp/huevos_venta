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
                    <li class="breadcrumb-item"><a href="<?= base_url('ventas/listado') ?>">Ventas</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Nueva Venta</li>
                </ol>
            </nav>
        </div>
        <div class="col-12">
            <form action="<?= isset($action) ? $action : '' ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="data_carrito" id="data_carrito" value="">
                <input type="hidden" name="costo_total" id="costo_total" value="">
                <div class="accordion" id="accordionVenta">
                    <div class="card">
                        <div class="card-header" data-toggle="collapse" role="button" data-target="#collapseCliente" aria-expanded="true" aria-controls="collapseCliente">
                            <span class="has-icon"> <i class="flaticon-user"></i> Seleccionar Cliente</span>

                        </div>

                        <div id="collapseCliente" class="collapse show" data-parent="#accordionVenta">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 text-left">
                                        <hr>
                                        <span style="font-size: 24px;"><b>Seleccionar Cliente</b></span>
                                    </div>
                                    <div class="col-12 pt-1 ">
                                        <select class="form-control" name="cliente_id" id="cliente_id">
                                            <option value="0">Seleccionar</option>
                                            <?php if (!empty($clientes)) : ?>
                                                <?php foreach ($clientes as $cliente) : ?>
                                                    <option value="<?= $cliente->id ?>"><?= $cliente->nombre . ' ' . $cliente->apellido_paterno . ' ' . $cliente->apellido_materno ?></option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                    <div class="col-2 pt-1 pb-5">
                                        <label class="ms-checkbox-wrap ms-checkbox-success">
                                            <input type="checkbox" id="check_nuevo_cliente" name="check_nuevo_cliente" value="true">
                                            <i class="ms-checkbox-check"></i>
                                        </label>
                                        <span>Nuevo Cliente</span>
                                    </div>
                                    <br>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-row">
                                                    <div class="col-md-4 mb-3">
                                                        <label for="nombre">Nombres</label>
                                                        <div class="input-group">
                                                            <input disabled type="text" class="form-control" name="nombre" id="nombre" placeholder="Ingrese Nombre...">
                                                            <div id="invalid_nombre" class="valid-feedback">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 mb-3">
                                                        <label for="apellido_paterno">Apellido Paterno</label>
                                                        <div class="input-group">
                                                            <input disabled type="text" class="form-control" name="apellido_paterno" id="apellido_paterno" placeholder="Ingrese Apellido Paterno...">
                                                            <div id="invalid_apellido_paterno">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 mb-3">
                                                        <label for="apellido_materno">Apellido Materno</label>
                                                        <div class="input-group">
                                                            <input disabled type="text" class="form-control" name="apellido_materno" id="apellido_materno" placeholder="Ingrese Apellido Materno...">
                                                            <div id="invalid_apellido_materno">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col-md-4 mb-3">
                                                        <label for="rut_factura">Rut a Facturar</label>
                                                        <div class="input-group">
                                                            <input disabled type="text" class="form-control" name="rut_factura" id="rut_factura" placeholder="Ingrese Rut a Facturar...">
                                                            <div id="invalid_rut_factura">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 mb-3">
                                                        <label for="celular">Celular</label>
                                                        <div class="input-group">
                                                            <input disabled type="text" class="form-control" name="celular" id="celular" placeholder="Ingrese Celular...">
                                                            <div id="invalid_celular">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 mb-3">
                                                        <label for="email">Email</label>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" disabled name="email" id="email" placeholder="Ingrese Email...">
                                                            <div id="invalid_email">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" data-toggle="collapse" role="button" data-target="#collapseProducto" aria-expanded="false" aria-controls="collapseProducto">
                            <span class="has-icon"> <i class="flaticon-supermarket"></i> Agregar Productos</span>
                        </div>

                        <div id="collapseProducto" class="collapse" data-parent="#accordionVenta">
                            <div class="card-body">
                                <div class="row ">

                                    <?php if (!empty($productos)) : ?>
                                        <?php foreach ($productos as $producto) : ?>
                                            <input type="hidden" id="precio_<?= $producto->id ?>" value="<?= $producto->precio ?>">
                                            <div class="col-md-3">
                                                <div class="alert alert-brand alert-outline h-100" role="alert" style="color: #374eae;">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="d-flex justify-content-center align-items-center">
                                                                <img src="<?= ASSETS_ICONS ?>huevos.png" width="100px" height="100px" alt="card_img">
                                                            </div>
                                                            <hr>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="row">
                                                                <div class="col-12" style="color: #374eae;">
                                                                    <h2 id="articulo_<?= $producto->id ?>"><?= strUpper($producto->nombre) ?></h2>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <p>
                                                                        <b>Stock:</b> <?= $producto->stock ?>
                                                                    </p>
                                                                </div>
                                                                <div class="col-6">
                                                                    <p>
                                                                        <b>Precio:</b> <?= $producto->precio ?>
                                                                    </p>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="row">
                                                                        <div class="col-5 pr-0 d-flex justify-content-start pt-2">
                                                                            <b>Formato</b>
                                                                        </div>
                                                                        <div class="col-7 d-flex justify-content-center align-items-center">
                                                                            <select id="formato_<?= $producto->id ?>" class="form-control">
                                                                                <option value="b">Bandeja</option>
                                                                                <option value="c">Caja</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="row">
                                                                <div class="col-5 pr-0 d-flex justify-content-start pt-2">
                                                                    <b>Cantidad</b>
                                                                </div>
                                                                <div class="col-7 d-flex justify-content-center align-items-center">
                                                                    <select id="cantidad_<?= $producto->id ?>" class="form-control">
                                                                        <?php for ($i = 1; $i <= 15; $i++) : ?>
                                                                            <option value="<?= $i ?>"><?= $i ?></option>
                                                                        <?php endfor; ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-5 pr-0 d-flex justify-content-start pt-2"><b>Precio</b></div>
                                                                <div class="col-7">
                                                                    <input type="text" id="precioxunidad_<?= $producto->id ?>" class="form-control" value="<?= $producto->precio ?>">
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <hr>
                                                                    <button type="button" id="<?= $producto->id ?>" class="btn btn-sm btn-primary w-100 btn_agregar_producto">Agregar</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                    <div class="col-12 mt-5 text-center">
                                        <hr>
                                        <span style="font-size: 36px;"><b>Carrito</b></span>
                                    </div>
                                    <div class="col-12 table-responsive">

                                        <table class="table" id="tableCarrito">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Producto</th>
                                                    <th>Precio x Caja</th>
                                                    <th>Cantidad</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" data-toggle="collapse" role="button" data-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                            <span class="has-icon"> <i class="flaticon-start"></i> Metodo De Pago</span>
                        </div>

                        <div id="collapseEight" class="collapse" data-parent="#accordionVenta">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <ul class="ms-list d-flex p-2">
                                            <li class="pr-3">
                                                <label class="ms-checkbox-wrap ms-checkbox-secondary">
                                                    <input type="radio" value="fiado" name="metodo_pago" class="metodo_pago">
                                                    <i class="ms-checkbox-check"></i>
                                                </label>
                                                <span> Fiado </span>
                                            </li>
                                            <li class="pr-3">
                                                <label class="ms-checkbox-wrap ms-checkbox-secondary">
                                                    <input type="radio" value="efectivo" name="metodo_pago" class="metodo_pago">
                                                    <i class="ms-checkbox-check"></i>
                                                </label>
                                                <span> Efectivo </span>
                                            </li>
                                            <li class="pr-3">
                                                <label class="ms-checkbox-wrap ms-checkbox-secondary">
                                                    <input type="radio" value="transferencia" name="metodo_pago" class="metodo_pago">
                                                    <i class="ms-checkbox-check"></i>
                                                </label>
                                                <span> Transferencia </span>
                                            </li>
                                            <li class="pr-3">
                                                <label class="ms-checkbox-wrap ms-checkbox-secondary">
                                                    <input type="radio" value="deposito" name="metodo_pago" class="metodo_pago">
                                                    <i class="ms-checkbox-check"></i>
                                                </label>
                                                <span> Deposito </span>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-12 col-xl-3 mt-3">
                                        <span style="font-size: 16px;"><b>Monto Pagado: </b><input class="form-control" disabled type="text" name="monto_pagado" id="monto_pagado" value=""></span>
                                    </div>
                                    <div class="col-12 col-xl-3 mt-5">
                                        <label class="ms-checkbox-wrap ms-checkbox-success">
                                            <input type="checkbox" id="check_pago_total" name="check_pago_total" value="true" checked="">
                                            <i class="ms-checkbox-check"></i>
                                        </label>
                                        <span>Pago Total Venta</span>
                                    </div>
                                    <div class="col-xl-6 mt-3">
                                    </div>
                                    <div class="col-12 mt-3" style="display: none;" id="col_comprobante">
                                        <span style="font-size: 16px;"><b>Adjuntar Comprobante</b></span>
                                        <hr>
                                        <input class="form-control" type="file" name="comprobante_pago" id="comprobante_pago">
                                        <img src="" width="300px" id="comprobante" alt="" class="img-responsive">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card" style="display: none;">
                        <div class="card-header" data-toggle="collapse" role="button" data-target="#collapseDespacho" aria-expanded="false" aria-controls="collapseDespacho">
                            <span class="has-icon"> <i class="flaticon-placeholder"></i>Asignar Despacho Del Producto </span>
                        </div>

                        <div id="collapseDespacho" class="collapse" data-parent="#accordionVenta">
                            <div class="card-body">

                            </div>
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary mt-4 d-block w-100" type="submit">Finalizar Venta</button>
            </form>
        </div>
    </div>
</div>