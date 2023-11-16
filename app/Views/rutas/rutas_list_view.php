<div class="ms-content-wrapper">
    <div class="row">
        <div class="col-md-12 col-xl-6">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb pl-0">
                    <li class="breadcrumb-item"><a href="<?= base_url('/') ?>"><i class="material-icons">home</i> Menu</a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url('rutas/listado') ?>">Listado Rutas</a></li>
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
    <div class="row">
        <div class="card card-body">
            <div class="col-12 table-responsive">
                <table id="data-table" class="table table-hover w-100 dataTable no-footer">
                    <thead>
                        <tr role="row">
                            <th class="text-center">#</th>
                            <th class="text-center" colspan="2">DETALLE RUTA</th>
                            <th class="text-center">Efectivo Ruta(efectivo)</th>
                            <th class="text-center">Cajas Total</th>
                            <th class="text-center">Cajas Vendidas</th>
                            <th class="text-center">Cantidad de Clientes</th>
                            <th class="text-center">Repartidor</th>
                            <th class="text-center">Fecha Ruta</th>
                            <th class="text-center">Estado Ruta</th>
                            <th class="text-center">Accion</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($rutas)) : $count = 1; ?>
                            <?php foreach ($rutas as $ruta) : $count++; ?>
                                <tr>
                                    <td class="text-center"><?= $count ?></td>
                                    <td colspan="2">
                                        <p><b>Total Venta: </b><?= !empty($ruta->total_venta) ? $ruta->total_venta : 'Sin Información' ?>
                                            <br>
                                            <b>Total Pagado: </b><?= !empty($ruta->total_pagado) ? $ruta->total_pagado : 'Sin Información' ?>
                                            <br>
                                            <b>Total Fiado: </b><?= !empty($ruta->total_fiado) ? $ruta->total_fiado : 'Sin Información' ?>
                                            <br>
                                            <b>Total Gastos: </b><?= !empty($ruta->gastos_ruta) ? $ruta->gastos_ruta : 'Sin Información' ?>
                                            <br>
                                        </p>
                                    </td>
                                    <td class="text-center"><?= !empty($ruta->efectivo_ruta) ? $ruta->efectivo_ruta : 'Sin Información' ?></td>
                                    <td class="text-center"><?= !empty($ruta->cajas_total) ? $ruta->cajas_total : 'Sin Información' ?></td>
                                    <td class="text-center"><?= !empty($ruta->cajas_vendidas) ? $ruta->cajas_vendidas : 0 ?></td>
                                    <td class="text-center"><?= !empty($ruta->cantidad_clientes) ? $ruta->cantidad_clientes : 'Sin Información' ?></td>
                                    <td class="text-center"><?= !empty($ruta->repartidor_id) ? GetRepartidor($ruta->repartidor_id)->nombre : 'Sin Información' ?></td>
                                    <td class="text-center"><?= !empty($ruta->fecha_ruta) ? ordenar_fechaHumano($ruta->fecha_ruta) : 'Sin Información' ?></td>
                                    <td class="text-center"><?= !empty($ruta->estado) ? $ruta->estado : 'Sin Información' ?></td>
                                    <td class="text-center">
                                        <a href="<?= base_url('rutas/ver/') . $ruta->id ?>" class="btn btn-sm btn-secondary "><i class="fas fa-eye fs-16"> Ver</i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>