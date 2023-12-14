<br>
<div class="container">
    <div class="row">
        <div class="col-1"></div>
        <div class="col-10">
            <div class="ms-card">
                <div class="ms-card-header">
                    <h2 class="text-center">
                        Venta N° <?= $venta->id ?>, Ruta: <?= $venta->ruta_id . ' (' . (!empty($venta->fecha_venta) ? getDiaMesAño($venta->fecha_venta) : getDiaMesAño($venta->created_at)) . ')' ?>
                    </h2>
                </div>
                <div class="ms-card-body">
                    <div class="row">
                        <div class="col-12">
                            <table class="table table-bordered">
                                <tr>
                                    <th class="text-center">Nombre Cliente</th>
                                    <th class="text-center">Total Venta</th>
                                    <th class="text-center">Total Pagado</th>
                                </tr>
                                <tr>
                                    <td class="text-center"><?= getNombreCompletoCliente($venta->cliente_id)->nombre_cliente ?></td>
                                    <td class="text-center"><?= formatear_numero($venta->total_venta) ?></td>
                                    <td class="text-center"><?= formatear_numero($venta->total_pagado) ?></td>
                                </tr>
                                <tr>
                                    <th class="text-center">Cajas Total</th>
                                    <th class="text-center">Fecha Ruta</th>
                                    <th class="text-center">Estado</th>
                                </tr>
                                <tr>
                                    <td class="text-center"><?= $venta->cajas_total ?></td>
                                    <td class="text-center"><?= !empty($venta->fecha_venta) ? getDiaMesAño($venta->fecha_venta) : getDiaMesAño($venta->created_at)  ?></td>
                                    <td class="text-center"><span class="badge badge-<?= $venta->pagado ? 'success' : 'warning' ?>"><?= $venta->pagado ? 'PAGADO' : 'PENDIENTE' ?></span></td>
                                </tr>
                            </table>
                        </div>
                        <br>
                        <div class="col-12">
                            <h1 class="text-center">Detalle Venta</h1>
                        </div>
                        <div class="col-12 table-responsive">
                            <table class="table" id="table_detalle_venta">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Calibre</th>
                                        <th>Tipo Huevo</th>
                                        <th>Precio</th>
                                        <th>Cantidad</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($productos_venta)) : ?>
                                        <?php foreach ($productos_venta as $producto) : ?>
                                            <tr>
                                                <td><?= $producto->id ?></td>
                                                <td><?= $producto->nombre_producto ?></td>
                                                <td><?= $producto->tipo_huevo == 'b' ? 'BLANCO' : 'COLOR' ?></td>
                                                <td><?= formatear_numero($producto->precio) ?></td>
                                                <td><?=  $producto->cantidad ?></td>
                                                <td><?= formatear_numero($producto->precio * $producto->cantidad) ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <tr>
                                            <td colspan="5" class="text-center">
                                                <h2><b>Venta sin productos</b></h2>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                        <br>
                        <div class="col-12">
                            <h1 class="text-center">Detalle Pagos</h1>
                        </div>
                        <div class="col-12 table-responsive">
                            <table class="table" id="table_detalle_pagos">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Monto Total Venta</th>
                                        <th>Monto Pago Actual</th>
                                        <th>Monto Total Pagado</th>
                                        <th>Metodo de Pago</th>
                                        <th>Fiado Pagado</th>
                                        <th>Fecha Ingreso Pago</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($pagos_venta)) : ?>
                                        <?php foreach ($pagos_venta as $pago) : ?>
                                            <tr>
                                                <td><?= $pago->id ?></td>
                                                <td><?= formatear_numero($pago->monto_total) ?></td>
                                                <td><?= formatear_numero($pago->monto_pago_actual) ?></td>
                                                <td><?= formatear_numero($pago->monto_pagado) ?></td>
                                                <td><?=  $pago->metodo_pago ?></td>
                                                <td><?=  $pago->fiado_pagado ? 'Si' : 'No' ?></td>
                                                <td><?= ordenar_fechaHumano($pago->created_at) ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <tr>
                                            <td colspan="5" class="text-center">
                                                <h2><b>Venta sin pagos</b></h2>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>