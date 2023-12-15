<div class="ms-content-wrapper">

    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb pl-0">
                    <li class="breadcrumb-item"><a href="<?= base_url('/') ?>"><i class="material-icons">home</i> Menu</a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url('deudas/listado') ?>">Listado Deudas</a></li>
                </ol>
            </nav>
        </div>
        <div class="col-12">
            <div class="card card-body table-responsive">
            <table id="data-table" class="table table-hover w-100 dataTable no-footer">
                <thead>
                    <tr role="row">
                        <th>N° VENTA</th>
                        <th>RUTA</th>
                        <th>CLIENTE</th>
                        <th>PRODUCTOS</th>
                        <th>TOTAL VENTA</th>
                        <th>TOTAL PAGADO</th>
                        <!-- <th>METODO PAGO</th> -->
                        <th class="text-center" style="white-space: nowrap;">ACCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($deudas)) : ?>
                        <?php foreach ($deudas as $deuda) : ?>
                            <tr>
                                <td><?= !empty($deuda->id) ? $deuda->id : 'Sin Información' ?></td>
                                <td><?= !empty($deuda->ruta_id) ? $deuda->ruta_id : 'Sin Información' ?></td>
                                <td><?= !empty($deuda->cliente_id) ? strUpper(getNombreCompletoCliente($deuda->cliente_id)->nombre_cliente) : 'Sin Información' ?></td>
                                <td><?= !empty($deuda->productos) ? $deuda->productos : 'Sin Información' ?></td>
                                <td><?= !empty($deuda->total_venta) ? formatear_numero($deuda->total_venta) : '$0' ?></td>
                                <td><?= !empty($deuda->total_pagado) ? formatear_numero($deuda->total_pagado) : '$0' ?></td>
                                <!-- <td><?= !empty($deuda->metodo_pago) ? $deuda->metodo_pago : 'Sin Información' ?></td> -->
                                <td style="white-space: nowrap;" class="text-center">
                                    <?php if ($deuda->total_venta > $deuda->total_pagado || !$deuda->pagado) : ?>
                                        <button class="btn btn-sm btn-success" id="btn_pagar_deuda"><i class="fas fa-dollar-sign"></i>Pagar Deuda</button>
                                    <?php endif; ?>
                                    <a href="<?= base_url('ventas/detalle/' . $deuda->id) ?>" class="btn btn-sm btn-info"><i class="fa fa-info" aria-hidden="true"></i> Ver Venta</a>
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