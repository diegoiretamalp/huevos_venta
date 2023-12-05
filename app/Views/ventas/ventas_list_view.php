<div class="ms-content-wrapper">
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb pl-0">
                    <li class="breadcrumb-item"><a href="<?= base_url('/') ?>"><i class="material-icons">home</i> Menu</a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url('ventas/listado') ?>">Listado Ventas</a></li>
                </ol>
            </nav>
        </div>
        <div class="col-12 table-responsive">
            <div class="card card-body">
                <table id="data-table" class="table table-hover w-100 dataTable no-footer">
                    <thead>
                        <tr role="row">
                            <th>N° VENTA</th>
                            <th>RUTA</th>
                            <th>CLIENTE</th>
                            <th>PRODUCTOS</th>
                            <th>TOTAL VENTA</th>
                            <th>TOTAL PAGADO</th>
                            <th>METODO PAGO</th>
                            <th>ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($ventas)) : ?>
                            <?php foreach ($ventas as $venta) : ?>
                                <tr>
                                    <td><?= !empty($venta->id) ? '#' . $venta->id : 'Sin Información' ?></td>
                                    <td><?= !empty($venta->ruta_id) ? $venta->ruta_id : 'Sin Información' ?></td>
                                    <td><?= !empty($venta->nombre_cliente) ? strUpper($venta->nombre_cliente) : 'Sin Información' ?></td>
                                    <td><?= !empty($venta->nombre_producto) ? $venta->nombre_producto : 'Sin Información' ?></td>
                                    <td><?= !empty($venta->total_venta) ? formatear_numero($venta->total_venta) : '$0' ?></td>
                                    <td><?= !empty($venta->total_pagado) ? formatear_numero($venta->total_pagado) : '$0' ?></td>
                                    <td><?= !empty($venta->metodo_pago) ? $venta->metodo_pago : 'Sin Información' ?></td>
                                    <td>
                                        <button class="btn btn-sm btn-info" id="btn_pagar_deuda"><i class="fas fa-dollar-sign"></i>Pagar Deuda</button>
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