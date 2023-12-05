<div class="ms-content-wrapper">
    <!--------breadcrumb-------->

    <div class="row">
        <div class="col-md-12 col-xl-6">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb pl-0">
                    <li class="breadcrumb-item"><a href="<?= base_url('/') ?>"><i class="material-icons">home</i> Menu</a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url('rutas/listado') ?>">Listado Rutas</a></li>
                    <li class="breadcrumb-item"><a href="#">Ver Ruta</a></li>
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
                    <div class="row">
                        <div class="col-12 text-center">
                            <h1 style="font-size: 32px;">Resumen de Ruta</h1>
                            <br>
                            <br>
                        </div>
                        <div class="col-md-12 text-left">
                            <a class="btn btn-sm btn-success" href="<?= base_url('rutas/cerrar-ruta/' . $ruta->id) ?>"><i class="fas fa-check"></i> Cerrar Ruta</a>
                            <button class="btn btn-sm btn-info" type="button" id="nuevo_gasto"><i class="fas fa-dollar-sign"></i> Nuevo Gasto</button>
                            <button class="btn btn-sm btn-info" type="button" id="nuevo_fiado_pagado"><i class="fa fa-credit-card" aria-hidden="true"></i> Nuevo Fiado Pagado</button>
                            <br>
                            <br>
                        </div>
                        <div class="col-md-7">
                            <div class="row">
                                <div class="col-4">
                                    <div class="ms-card card-success ms-widget ms-infographics-widget">
                                        <div class="ms-card-body media text-center">
                                            <div class="media-body">
                                                <h2 class="text-white">Total Venta</h2>
                                                <p class="ms-card-change"><?= !empty($ruta->total_venta) ? formatear_numero($ruta->total_venta) : '$0' ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="ms-card card-primary card-shadow ms-widget ms-infographics-widget">
                                        <div class="ms-card-body media text-center">
                                            <div class="media-body">
                                                <h2 class="text-white">Total Pagado</h2>
                                                <p class="ms-card-change"><?= !empty($ruta->total_pagado) ? formatear_numero($ruta->total_pagado) : '$0' ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="ms-card card-warning ms-widget ms-infographics-widget">
                                        <div class="ms-card-body media text-center">
                                            <div class="media-body">
                                                <h2 class="text-white">Total Gastos</h2>
                                                <p class="ms-card-change"><?= !empty($ruta->gastos_ruta) ? formatear_numero($ruta->gastos_ruta) : '$0' ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="ms-card card-warning ms-widget ms-infographics-widget">
                                        <div class="ms-card-body media text-center">
                                            <div class="media-body">
                                                <h2 class="text-white">Total Efectivo</h2>
                                                <p class="ms-card-change"><?= !empty($ruta->total_efectivo) ? formatear_numero($ruta->total_efectivo) : '$0' ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="ms-card card-warning ms-widget ms-infographics-widget">
                                        <div class="ms-card-body media text-center">
                                            <div class="media-body">
                                                <h2 class="text-white">Total Fiado</h2>
                                                <p class="ms-card-change"><?= !empty($ruta->total_fiado) ? formatear_numero($ruta->total_fiado) : '$0' ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="ms-card card-warning ms-widget ms-infographics-widget">
                                        <div class="ms-card-body media text-center">
                                            <div class="media-body">
                                                <h2 class="text-white">Total Transferencia</h2>
                                                <p class="ms-card-change"><?= !empty($ruta->total_transferencia) ? formatear_numero($ruta->total_transferencia) : '$0' ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5 table-responsive">
                            <table class="table" id="table_gastos">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th class="text-center">Gasto</th>
                                        <th class="text-center">Monto</th>
                                        <th style="white-space: nowrap; text-align: center;">Fecha</th>
                                        <th style="white-space: nowrap; text-align: center;">Accion</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($gastos)) : $count = 0; ?>
                                        <?php foreach ($gastos as $gasto) : $count++; ?>
                                            <tr>
                                                <td>#<?= $count ?></td>
                                                <td class="text-center"><?= !empty($gasto->nombre) ? $gasto->nombre : 'Sin Información' ?></td>
                                                <td class="text-center"><?= !empty($gasto->monto) ? formatear_miles($gasto->monto) : 'Sin Información' ?></td>
                                                <td style="white-space: nowrap; text-align: center;"><?= !empty($gasto->created_at) ? ordenar_fechaHumano($gasto->created_at) : 'Sin Informacón' ?></td>
                                                <td style="white-space: nowrap; text-align: center;">
                                                    <button class="ms-btn-icon btn-info" type="button" onclick="EditarGasto(<?= $gasto->id ?>)"><i class="fas fa-pencil-alt pl-2"></i></button>
                                                    <button class="ms-btn-icon btn-danger" type="button" onclick="EliminarGasto(<?= $gasto->id ?>)"><i class="fa fa-trash pl-2" aria-hidden="true"></i></button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <input type="text" class="form-control" id="buscar_cliente" placeholder="Ingrese el nombre del Cliente...">
            <br>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div class="ms-card">
                <div class="ms-card-body">
                    <ul class="ms-activity-log" id="lista">
                        <?php if (!empty($clientes_ruta)) : ?>
                            <?php foreach ($clientes_ruta as $cliente) : ?>
                                <li>
                                    <div class="ms-btn-icon btn-pill icon" style="width: 60px;">
                                        <select class="form-control" name="" disabled id="">
                                            <option value="" selected><?= $cliente->posicion ?></option>
                                        </select>
                                    </div>
                                    <br>
                                    <br>
                                    <h6><b><?= !empty($cliente->nombre_completo) ? $cliente->nombre_completo : 'Sin información' ?></b>
                                        <span class="badge badge-<?= $cliente->estado_cliente_ruta_id == 1 ? 'success' : ($cliente->estado_cliente_ruta_id == 2 ? 'warning' : 'secondary') ?>"><?= $cliente->estado_cliente_ruta_id == 1 ? 'FINALIZADO' : ($cliente->estado_cliente_ruta_id == 2 ? 'PENDIENTE' : 'SECONDARY') ?></span>
                                        <span role="button" onclick="VerDeudasCliente(<?= $cliente->cliente_id ?>)" id="btn_ver_deuda" style="cursor: pointer;" class="badge badge-danger">Ver Deuda</span>
                                        <span class="badge badge-info" role="button" onclick="CargarCliente(<?= $cliente->cliente_id ?>)" id="btn_venta_<?= $cliente->cliente_id ?>" style="cursor: pointer;" hidden data-toggle="modal" data-target="#modal-15">Nueva Venta</span>
                                    </h6>
                                    <br>
                                    <span style="display: none;"> <i class="material-icons">event</i>ULTIMA COMPRA: <?= !empty($cliente->fecha_ultima_compra) ? $cliente->fecha_ultima_compra : 'Sin Información...' ?></span>
                                    <div class="row">
                                        <div class="col-4">
                                            <p class="fs-14"><b>Categoria Favorita: </b><?= !empty($cliente->cliente_data->producto_id) ? $cliente->cliente_data->producto_id : 'Sin Información' ?></p>
                                            <p class="fs-14"><b>Precio Favorito: </b><?= !empty($cliente->cliente_data->precio_favorito) ? $cliente->cliente_data->precio_favorito : 'Sin Información' ?></p>
                                        </div>
                                        <div class="col-6">
                                            <p class="fs-14"><b>Total Deuda: </b><?= !empty($cliente->total_deuda) ? $cliente->total_deuda : 'Sin Información' ?></p>
                                            <p class="fs-14"><b>Direccion: </b><?= !empty($cliente->direccion) ? $cliente->direccion : 'Sin Información' ?> <a href="#" target="_blank"> <i class="fas fa-share-square"></i> Abrir Maps</a></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 d-flex justify-content-start">
                                            <button class="btn btn-sm btn-secondary" type="button" onclick="CargarCliente(<?= $cliente->cliente_id ?>)" id="<?= $cliente->cliente_id ?>" name="nueva_venta" data-toggle="modal" data-target="#modal-15">Nueva Venta</button>
                                            <div class="row table-responsive">
                                                <div class="col-md-12">
                                                    <table class="table table-hover w-100 dataTable no-footer" id="table_ventas_<?= $cliente->cliente_id ?>">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center">#</th>
                                                                <th class="text-center">Producto</th>
                                                                <th class="text-center">Cantidad</th>
                                                                <!-- <th class="text-center">Precio</th> -->
                                                                <th class="text-center">Total Venta</th>
                                                                <th class="text-center">Total Pagado</th>
                                                                <!-- <th class="text-center">Metodo Pago</th> -->
                                                            </tr>
                                                        </thead>
                                                        <tbody id="tbody_ventas_<?= $cliente->cliente_id ?>">
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </li>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modal-15">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <form action="<?= base_url() ?>" id="formularioCarrito" method="post">
                    <input type="hidden" id="data_caarrito" name="data_carrito">
                    <div class="accordion" id="accordionVenta">
                        <div class="card">
                            <div class="card-header" data-toggle="collapse" role="button" data-target="#collapseCliente" aria-expanded="false" aria-controls="collapseCliente">
                                <span class="has-icon"> <i class="flaticon-user"></i>CLIENTE <b id="cliente_accordion"></b></span>

                            </div>

                            <div id="collapseCliente" class="collapse" data-parent="#accordionVenta">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 text-left">
                                            <hr>
                                            <span style="font-size: 24px;"><b>Seleccionar Cliente</b></span>
                                        </div>
                                        <div class="col-12 pt-1 ">
                                            <select class="form-control" disabled name="cliente_id" id="cliente_id">
                                            </select>
                                        </div>
                                        <div class="col-4 pt-1 pb-5" style="display: none;">
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
                                                        <div class="col-12 mb-3">
                                                            <label for="nombre">Nombres</label>
                                                            <div class="input-group">
                                                                <input disabled type="text" class="form-control" name="nombre" id="nombre" placeholder="Ingrese Nombre...">
                                                                <div id="invalid_nombre" class="valid-feedback">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 mb-3">
                                                            <label for="apellido_paterno">Apellido Paterno</label>
                                                            <div class="input-group">
                                                                <input disabled type="text" class="form-control" name="apellido_paterno" id="apellido_paterno" placeholder="Ingrese Apellido Paterno...">
                                                                <div id="invalid_apellido_paterno">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 mb-3">
                                                            <label for="apellido_materno">Apellido Materno</label>
                                                            <div class="input-group">
                                                                <input disabled type="text" class="form-control" name="apellido_materno" id="apellido_materno" placeholder="Ingrese Apellido Materno...">
                                                                <div id="invalid_apellido_materno">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="col-12 mb-3">
                                                            <label for="rut_factura">Rut a Facturar</label>
                                                            <div class="input-group">
                                                                <input disabled type="text" class="form-control" name="rut_factura" id="rut_factura" placeholder="Ingrese Rut a Facturar...">
                                                                <div id="invalid_rut_factura">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12mb-3">
                                                            <label for="celular">Celular</label>
                                                            <div class="input-group">
                                                                <input disabled type="text" class="form-control" name="celular" id="celular" placeholder="Ingrese Celular...">
                                                                <div id="invalid_celular">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 mb-3">
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
                            <div class="card-header" data-toggle="collapse" role="button" data-target="#collapseProducto" aria-expanded="true" aria-controls="collapseProducto">
                                <span class="has-icon"> <i class="flaticon-supermarket"></i> Agregar Productos</span>
                            </div>

                            <div id="collapseProducto" class="collapse show" data-parent="#accordionVenta">
                                <div class="card-body">
                                    <div class="row ">

                                        <?php if (!empty($productos)) : ?>
                                            <?php foreach ($productos as $producto) : ?>
                                                <input type="hidden" id="precio_producto">
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                        <div class="col-md-12">
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
                                                                <h2 id="articulo_producto"></h2>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <p>
                                                                    <b id="stock_value">Stock: </b>
                                                                </p>
                                                            </div>
                                                            <div class="col-6">
                                                                <p>
                                                                    <b id="precio_value">Precio:</b>
                                                                </p>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="row">
                                                                    <div class="col-5 pr-0 d-flex justify-content-start pt-2">
                                                                        <b>Calibre Huevo</b>
                                                                    </div>
                                                                    <div class="col-7 d-flex justify-content-center align-items-center">
                                                                        <select id="producto_id" name="producto_id" class="form-control">
                                                                            <?php if (!empty($productos)) : ?>
                                                                                <?php foreach ($productos as $producto) : ?>
                                                                                    <option value="<?= $producto->id ?>"><?= $producto->nombre ?></option>
                                                                                <?php endforeach; ?>
                                                                            <?php endif; ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="row">
                                                                    <div class="col-5 pr-0 d-flex justify-content-start pt-2">
                                                                        <b>Tipo</b>
                                                                    </div>
                                                                    <div class="col-7 d-flex justify-content-center align-items-center">
                                                                        <select id="tipo_huevo" name="tipo_huevo" class="form-control">
                                                                            <option value="b" selected>Blanco</option>
                                                                            <option value="c">Color</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="row">
                                                                    <div class="col-5 pr-0 d-flex justify-content-start pt-2">
                                                                        <b>Formato</b>
                                                                    </div>
                                                                    <div class="col-7 d-flex justify-content-center align-items-center">
                                                                        <select id="formato_huevo" name="formato_huevo" class="form-control">
                                                                            <option value="b">Bandeja</option>
                                                                            <option value="c" selected>Caja</option>
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
                                                                <input name="cantidad" id="cantidad" type="text" class="form-control" value="1">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-5 pr-0 d-flex justify-content-start pt-2"><b>Precio Favorito</b></div>
                                                            <div class="col-7">
                                                                <input type="text" id="precio" name="precio" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <hr>
                                                                <button type="button" id="btn_agregar_producto" class="btn btn-sm btn-primary w-100 btn_agregar_producto">Agregar</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
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
                                                        <th>Precio</th>
                                                        <th>Tipo</th>
                                                        <th>Formato</th>
                                                        <th>Cantidad</th>
                                                        <th>Total</th>
                                                        <th>Accion</th>
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
                                                        <input type="radio" value="1" name="metodo_pago" class="metodo_pago">
                                                        <i class="ms-checkbox-check"></i>
                                                    </label>
                                                    <span> Fiado </span>
                                                </li>
                                                <li class="pr-3">
                                                    <label class="ms-checkbox-wrap ms-checkbox-secondary">
                                                        <input type="radio" value="2" name="metodo_pago" class="metodo_pago">
                                                        <i class="ms-checkbox-check"></i>
                                                    </label>
                                                    <span> Efectivo </span>
                                                </li>
                                                <li class="pr-3">
                                                    <label class="ms-checkbox-wrap ms-checkbox-secondary">
                                                        <input type="radio" value="3" name="metodo_pago" class="metodo_pago">
                                                        <i class="ms-checkbox-check"></i>
                                                    </label>
                                                    <span> Transferencia </span>
                                                </li>
                                                <li class="pr-3">
                                                    <label class="ms-checkbox-wrap ms-checkbox-secondary">
                                                        <input type="radio" value="4" name="metodo_pago" class="metodo_pago">
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
                        <div class="card">
                            <div class="card-header" data-toggle="collapse" role="button" data-target="#collapseResumen" aria-expanded="false" aria-controls="collapseResumen">
                                <span class="has-icon"> <i class="flaticon-placeholder"></i>Resumen de Venta </span>
                            </div>

                            <div id="collapseResumen" class="collapse" data-parent="#accordionVenta">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <h2>Cliente</h2>
                                            <hr>
                                        </div>
                                        <div class="col-12">
                                            <p>
                                                Nombre Completo: <b id="nombre_completo_cliente"></b>
                                            </p>
                                            <p>
                                                Rut a Facturar: <b id="rut_factura_cliente"></b>
                                            </p>
                                            <p>
                                                Contacto: <b id="contacto_cliente"></b>
                                            </p>
                                        </div>

                                        <div class="col-12">
                                            <br>
                                            <h2>Producto Detalle</h2>
                                            <hr>
                                        </div>
                                        <div class="col-12">
                                            <p>
                                                Total Venta: <b id="total_venta"></b>
                                            </p>
                                            <p>
                                                Metodo de Pago: <b id="metodo_pago_seleccionado"></b>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row d-flex justify-content-start">
                                        <button class="btn btn-sm btn-success" type="button" id="btn_finalizar_venta">Finalizar Venta</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="modal_deudas" tabindex="-1" role="dialog" aria-labelledby="modal-1">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h3 class="modal-title "><i class="flaticon-alert-1 bg-primary text-white"></i> DEUDAS DEL CLIENTE</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>

            <div class="modal-body">
                <table class="table table-hover w-100 dataTable no-footer" id="table_deudas">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Ruta</th>
                            <th>Monto Deuda</th>
                            <th>Monto Pagado</th>
                            <th>Fecha Deuda</th>
                        </tr>
                    </thead>
                    <tbody id="tbody_deudas">
                    </tbody>
                </table>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Cerrar</button>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="modal_gasto">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Nuevo Gasto de Ruta</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <label for="nombre_gasto">Nombre</label>
                    <input type="text" name="nombre_gasto" id="nombre_gasto" class="form-control">
                    <span class="invalid_nombre_gasto"></span>
                </div>
                <div class="form-group">
                    <label for="monto_gasto">Monto</label>
                    <input type="text" name="monto_gasto" id="monto_gasto" class="form-control">
                    <span class="invalid_monto_gasto"></span>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary shadow-none" id="confirmar_gasto">Confirmar</button>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="modal_cerrar_ruta">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">RESUMEN DE RUTA</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-12 col-md-3">
                        <div class="form-group">
                            <label for="cr_total_ventas">Total Ventas</label>
                            <input type="text" name="cr_total_ventas" id="cr_total_ventas" class="form-control" disabled aria-describedby="invalid_cr_total_ventas">
                            <small id="invalid_cr_total_ventas" class="text-muted"></small>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="form-group">
                            <label for="cr_total_ventas">Total Pagado</label>
                            <input type="text" name="cr_total_ventas" id="cr_total_ventas" class="form-control" disabled aria-describedby="invalid_cr_total_ventas">
                            <small id="invalid_cr_total_ventas" class="text-muted"></small>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="form-group">
                            <label for="cr_total_ventas">Total Deuda</label>
                            <input type="text" name="cr_total_ventas" id="cr_total_ventas" class="form-control" disabled aria-describedby="invalid_cr_total_ventas">
                            <small id="invalid_cr_total_ventas" class="text-muted"></small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary shadow-none" id="btn_finalizar_ruta">Finalizar</button>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" style="transition-duration: 0.1s;" id="modal_fiado_pagado">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">NUEVO FIADO PAGADO</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <label for="cliente_fiado_pagado">Selecciona Cliente Con Deuda</label>
                        <br>
                        <select style="width: 100%;" name="cliente_fiado_pagado" id="cliente_fiado_pagado">
                            <?php if (!empty($clientes_deuda)) : ?>
                                <option value="0" selected>Seleccionar</option>
                                <?php foreach ($clientes_deuda as $cliente) : ?>
                                    <option value="<?= $cliente->id ?>"><?= !empty($cliente->nombre) ? $cliente->nombre . ' Deuda Total: ' . formatear_numero($cliente->total_deuda) : 'Sin Informacion' ?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                        <span id="invalid_cliente_fiado_pagado" class="text-danger"></span>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12 table-responsive">
                        <table id="table-deudas-cliente" class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Ruta</th>
                                    <th>Venta</th>
                                    <th>Pagado</th>
                                    <th>Deuda</th>
                                    <th style="white-space: nowrap;">Fecha Venta</th>
                                    <th>Accion</th>
                                </tr>
                            </thead>
                            <tbody id="tbody_deudas_cliente">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
            </div>

        </div>
    </div>
</div>
<div class="modal fade" style="transition-duration: 0.1s;" id="modal_pagar_deuda">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Pagar Deuda</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="monto_deuda">Monto</label>
                            <input type="number" name="monto_deuda" id="monto_deuda" class="form-control" placeholder="Ingrese monto...">
                            <input type="hidden" name="monto_deuda_ant" id="monto_deuda_ant">
                            <span id="invalid_monto_deuda" class="text-danger"></span>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <ul class="ms-list d-flex justify-content-center p-2">
                            <li class="pr-3">
                                <label class="ms-checkbox-wrap ms-checkbox-secondary">
                                    <input checked type="radio" value="2" name="metodo_pago_deuda" class="metodo_pago_deuda">
                                    <i class="ms-checkbox-check"></i>
                                </label>
                                <span> Efectivo </span>
                            </li>
                            <li class="pr-3">
                                <label class="ms-checkbox-wrap ms-checkbox-secondary">
                                    <input type="radio" value="3" name="metodo_pago_deuda" class="metodo_pago_deuda">
                                    <i class="ms-checkbox-check"></i>
                                </label>
                                <span> Transferencia </span>
                            </li>
                            <li class="pr-3">
                                <label class="ms-checkbox-wrap ms-checkbox-secondary">
                                    <input type="radio" value="4" name="metodo_pago_deuda" class="metodo_pago_deuda">
                                    <i class="ms-checkbox-check"></i>
                                </label>
                                <span> Deposito </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light" id="btn_modal_atras"><i class="fa fa-arrow-left" aria-hidden="true"></i> Atrás</button>
                <button type="button" class="btn btn-primary shadow-none" id="btn_finalizar_pago"><i class="fas fa-dollar-sign    "></i> Pagar</button>
            </div>

        </div>
    </div>
</div>
<input type="hidden" id="deuda_id">