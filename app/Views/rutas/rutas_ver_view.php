<div class="ms-content-wrapper">
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
                        <div class="col-md-7">
                            <div class="row">
                                <div class="col-4">
                                    <div class="ms-card card-success ms-widget ms-infographics-widget">
                                        <div class="ms-card-body media text-center">
                                            <div class="media-body">
                                                <h1 class="text-white">Total Venta</h1>
                                                <p class="ms-card-change"><?= !empty($ruta->total_venta) ? formatear_numero($ruta->total_venta) : '$0' ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="ms-card card-primary ms-widget ms-infographics-widget">
                                        <div class="ms-card-body media text-center">
                                            <div class="media-body">
                                                <h1 class="text-white">Total Pagado</h1>
                                                <p class="ms-card-change"><?= !empty($ruta->total_pagado) ? formatear_numero($ruta->total_pagado) : '$0' ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="ms-card card-warning ms-widget ms-infographics-widget">
                                        <div class="ms-card-body media text-center">
                                            <div class="media-body">
                                                <h1 class="text-white">Total Gastos</h1>
                                                <p class="ms-card-change"><?= !empty($ruta->total_gastos) ? formatear_numero($ruta->total_gastos) : '$0' ?></p>
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
                                                <h1 class="text-white">Total Efectivo</h1>
                                                <p class="ms-card-change"><?= !empty($ruta->total_efectivo) ? formatear_numero($ruta->total_efectivo) : '$0' ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="ms-card card-warning ms-widget ms-infographics-widget">
                                        <div class="ms-card-body media text-center">
                                            <div class="media-body">
                                                <h1 class="text-white">Total Fiado</h1>
                                                <p class="ms-card-change"><?= !empty($ruta->total_fiado) ? formatear_numero($ruta->total_fiado) : '$0' ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="ms-card card-warning ms-widget ms-infographics-widget">
                                        <div class="ms-card-body media text-center">
                                            <div class="media-body">
                                                <h1 class="text-white">Total Transferencia</h1>
                                                <p class="ms-card-change"><?= !empty($ruta->total_transferencia) ? formatear_numero($ruta->total_transferencia) : '$0' ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Gasto</th>
                                        <th>Monto</th>
                                        <th>Fecha</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>

                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div class="ms-card">
                <div class="ms-card-body">
                    <ul class="ms-activity-log">
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
                                    <h6><?= !empty($cliente->nombre_completo) ? $cliente->nombre_completo : 'Sin información' ?> <span class="badge badge-<?= $cliente->estado_cliente_ruta_id == 1 ? 'success' : ($cliente->estado_cliente_ruta_id == 2 ? 'warning' : 'secondary') ?>"><?= $cliente->estado_cliente_ruta_id == 1 ? 'FINALIZADO' : ($cliente->estado_cliente_ruta_id == 2 ? 'PENDIENTE' : 'SECONDARY') ?></span>
                                        <span role="button" onclick="VerDeudasCliente(<?= $cliente->cliente_id ?>)" id="btn_ver_deuda" style="cursor: pointer;" class="badge badge-danger">Ver Deuda</span>
                                    </h6>
                                    <span> <i class="material-icons">event</i>ULTIMA COMPRA: <?= !empty($cliente->fecha_ultima_compra) ? $cliente->fecha_ultima_compra : 'Sin Información...' ?></span>
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
                                            <button class="btn btn-sm btn-secondary btn_nueva_venta" type="button" id="<?= $cliente->cliente_id ?>" name="nueva_venta" data-toggle="modal" data-target="#modal-15">Nueva Venta</button>
                                            <div class="row table-responsive">
                                                <div class="col-md-12">
                                                    <table class="table table-hover w-100 dataTable no-footer" id="table_ventas_<?= $cliente->cliente_id ?>">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Producto</th>
                                                                <th>Total Venta</th>
                                                                <th>Pagado</th>
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


<div class="modal fade" id="modal-15" tabindex="-1" role="dialog" aria-labelledby="modal-15">
    <div class="modal-dialog modal-lg" role="document">
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
                <h3 class="modal-title has-icon ms-icon-round "><i class="flaticon-alert-1 bg-primary text-white"></i> DEUDAS DEL CLIENTE!</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>

            <div class="modal-body">
                <div class="alert alert-danger alert-outline" role="alert">
                    <table class="table table-hover w-100 dataTable no-footer" id="table_deudas">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Monto Deuda</th>
                                <th>Monto Pagado</th>
                                <th>Fecha Deuda</th>
                            </tr>
                        </thead>
                        <tbody id="tbody_deudas">
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Cerrar</button>
            </div>

        </div>
    </div>
</div>