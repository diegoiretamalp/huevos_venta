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
                            <th colspan="2" class="text-center">TOTALES VENTA</th>
                            <th class="text-center">Cajas Total</th>
                            <th class="text-center">Cajas Vendidas</th>
                            <th class="text-center">Cantidad de Clientes</th>
                            <th class="text-center">Repartidor</th>
                            <th class="text-center" style="white-space: nowrap;">Fecha Ruta</th>
                            <th class="text-center">Accion</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($rutas)) : $count = 1; ?>
                            <?php foreach ($rutas as $ruta) : $count++; ?>
                                <tr id="row_<?= $ruta->id ?>">
                                    <td class="text-center"><?= $count ?></td>
                                    <td colspan="2">
                                        <div class="row">
                                            <div class="col-12 col-sm-6 col-xl-4">
                                                <b>T. Venta: </b>
                                                <br>
                                                <?= !empty($ruta->total_venta) ? formatear_numero($ruta->total_venta) : '$0' ?>

                                            </div>
                                            <div class="col-12 col-sm-6 col-xl-4">
                                                <b>T. Pagado: </b>
                                                <br>
                                                <?= !empty($ruta->total_pagado) ? formatear_numero($ruta->total_pagado) : '$0' ?>
                                            </div>
                                            <div class="col-12 col-sm-6 col-xl-4">
                                                <b>T. Gastos: </b>
                                                <br>
                                                <?= !empty($ruta->gastos_ruta) ? formatear_numero($ruta->gastos_ruta) : '$0' ?>
                                            </div>
                                            <div class="col-12 col-sm-6 col-xl-4">
                                                <b>T. Fiado: </b>
                                                <br>
                                                <?= !empty($ruta->total_fiado) ? formatear_numero($ruta->total_fiado) : '$0' ?>
                                            </div>
                                            <div class="col-12 col-sm-6 col-xl-4">
                                                <b>T. Efectivo: </b>
                                                <br>
                                                <?= !empty($ruta->total_efectivo) ? formatear_numero($ruta->total_efectivo) : '$0' ?>
                                            </div>
                                            <div class="col-12 col-sm-6 col-xl-4">
                                                <b>T. Transfer: </b>
                                                <br>
                                                <?= !empty($ruta->total_transferencia) ? formatear_numero($ruta->total_transferencia) : '$0' ?>
                                            </div>

                                        </div>
                                    </td>
                                    <!-- <td class="text-center"><?= !empty($ruta->total_efectivo) ? formatear_numero($ruta->total_efectivo) : '$0' ?></td> -->
                                    <td class="text-center"><?= !empty($ruta->cajas_total) ? $ruta->cajas_total : '0' ?></td>
                                    <td class="text-center"><?= !empty($ruta->cajas_vendidas) ? $ruta->cajas_vendidas : 0 ?></td>
                                    <td class="text-center"><?= !empty($ruta->cantidad_clientes) ? $ruta->cantidad_clientes : '0' ?></td>
                                    <td class="text-center"><?= !empty($ruta->repartidor_id) ? (!empty($dataR = GetRepartidor($ruta->repartidor_id)) ? $dataR->nombre : 'Sin Información') : 'Sin Información' ?></td>
                                    <td class="text-center" style="white-space: nowrap;"><?= !empty($ruta->fecha_ruta) ? ordenar_fechaHumano($ruta->fecha_ruta) : 'Sin Información' ?></td>
                                    <td class="text-center">
                                        <a href="<?= base_url('rutas/ver/') . $ruta->id ?>" class="btn btn-sm btn-secondary "><i class="fas fa-eye fs-16"> Ver</i></a>
                                        <button type="button" onclick="EliminarRuta(<?= $ruta->id ?>)" class="btn btn-sm btn-danger btn_deleted "><i class="fa fa-trash"></i> Eliminar
                                        </button>
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