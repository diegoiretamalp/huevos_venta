<div class="ms-content-wrapper">
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb pl-0">
                    <li class="breadcrumb-item"><a href="<?= base_url('/') ?>"><i class="material-icons">home</i> Menu</a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url('clientes/listado') ?>">Clientes</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Ver Cliente</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-2 col-md-6">
            <div class="ms-card card-gradient-success ms-widget ms-infographics-widget">
                <div class="ms-card-body media text-center">
                    <div class="media-body">
                        <h1 class="text-white">Total Compra</h1>
                        <p class="ms-card-change"><?= !empty($cartera->total_compra) ? formatear_numero($cartera->total_compra) : '$0' ?></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-md-6">
            <div class="ms-card card-gradient-warning ms-widget ms-infographics-widget">
                <div class="ms-card-body media text-center">
                    <div class="media-body">
                        <h1 class="text-white">Total Pagado</h1>
                        <p class="ms-card-change"> <?= !empty($cartera->total_pagado) ? formatear_numero($cartera->total_pagado) : '$0' ?></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-md-6">
            <div class="ms-card card-gradient-danger ms-widget ms-infographics-widget">
                <div class="ms-card-body media text-center">
                    <div class="media-body">
                        <h1 class="text-white">Total Deuda</h1>
                        <p class="ms-card-change"> <?= formatear_numero($cartera->total_compra - $cartera->total_pagado) ?></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-md-6">
            <div class="ms-card card-gradient-info ms-widget ms-infographics-widget">
                <div class="ms-card-body media text-center">
                    <div class="media-body">
                        <h1 class="text-white">N° Compras</h1>
                        <p class="ms-card-change"> <?= !empty($ventas) ? count($ventas) : 0 ?></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-md-6">
            <div class="ms-card card-gradient-info ms-widget ms-infographics-widget">
                <div class="ms-card-body media text-center">
                    <div class="media-body">
                        <h1 class="text-white">Precio Favorito</h1>
                        <p class="ms-card-change"> <?= !empty($cliente) ? (!empty($cliente->precio_favorito) ? formatear_numero(soloNumeros($cliente->precio_favorito)) : '0') : 0 ?></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-md-6">
            <div class="ms-card card-gradient-info ms-widget ms-infographics-widget">
                <div class="ms-card-body media text-center">
                    <div class="media-body">
                        <h1 class="text-white">Producto Favorito</h1>
                        <p class="ms-card-change"> <?= !empty($cliente->nombre_producto) ? $cliente->nombre_producto : 0 ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="ms-panel ms-panel-fh">
                <div class="ms-panel-header">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h1>Últimas Compras</h1>
                        </div>
                        <!-- <a href="<?= base_url('ventas/ver-todo/1') ?>" class="btn btn-primary"> Ver Todo</a> -->
                    </div>
                </div>
                <div class="ms-panel-body p-0">
                    <ul class="ms-list ms-feed ms-twitter-feed ms-recent-support-tickets">
                        <?php if (!empty($ventas)) : ?>
                            <?php foreach ($ventas as $venta) : ?>
                                <li class="ms-list-item">
                                    <a href="#" class="media clearfix">
                                        <div class="media-body">
                                            <div class="d-flex justify-content-between">
                                                <h4 class="ms-feed-user mb-0">Venta <strong>#<?= $venta->id ?></strong></h4>
                                            </div>
                                            <span class="ml-auto"> <i class="material-icons" style="font-size: 22px;">date_range</i> <?= !empty($venta->fecha_venta) ? ordenar_fechaHumano($venta->fecha_venta) : ordenar_fechaHumano($venta->created_at) ?></span>
                                            <div class="d-flex justify-content-between align-items-end pt-2">
                                                <div class="ms-feed-controls">
                                                    <span>
                                                        <i class="fas fa-box pr-2" style="font-size: 20px;"></i> Cajas: <?= !empty($venta->cajas_total) ? $venta->cajas_total : '$0' ?><br>
                                                        <i class="fas fa-route pr-2" style="font-size: 20px;"></i> Ruta: <?= !empty($venta->ruta_id) ? $venta->ruta_id : 'Sin Información' ?>
                                                    </span>
                                                    <span>
                                                        <i class="fas fa-dollar-sign pr-2" style="font-size: 20px;"></i> Total Venta: <?= !empty($venta->total_venta) ? formatear_numero($venta->total_venta) : '$0' ?><br>
                                                        <i class="far fa-money-bill-alt pr-2" style="font-size: 20px;"></i> Total Pagado: <?= !empty($venta->total_pagado) ? formatear_numero($venta->total_pagado) : '$0' ?>
                                                    </span>
                                                    <span>
                                                        <a href="<?= base_url('ventas/detalle/' . $venta->id) ?>" class="btn btn-info"><i class="fas fa-info-circle"></i> Ver Detalle</a>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <li class="ms-list-item text-center text-muted" style="font-size: 24px;">
                                No se encontraron ventas.
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="ms-panel ms-panel-fh">
                <div class="ms-panel-body">
                    <h2 class="section-title">INFORMACIÓN BÁSICA</h2>
                    <table class="table ms-profile-information">
                        <tbody>
                            <tr>
                                <th scope="row">NOMBRE COMPLETO</th>
                                <td><?= strUpper($cliente->nombre) . ' ' .  strUpper($cliente->apellido_paterno) . ' ' . strUpper($cliente->apellido_materno) ?></td>
                            </tr>
                            <tr>
                                <th scope="row">NOMBRE NEGOCIO</th>
                                <td><?= strUpper($cliente->nombre_negocio) . ' ' .  strUpper($cliente->nombre_negocio) . ' ' . strUpper($cliente->nombre_negocio) ?></td>
                            </tr>
                            <tr>
                                <th scope="row">RUT A FACTURAR</th>
                                <td><?= !empty($cliente->rut_factura) ? formateaRut($cliente->rut_factura) : '0.000.000-0' ?></td>
                            </tr>
                            <tr>
                                <th scope="row">CELULAR</th>
                                <td><?= !empty($cliente->celular) ? '+' . $cliente->celular : '+56 9' ?></td>
                            </tr>
                            <tr>
                                <th scope="row">EMAIL</th>
                                <td><?= !empty($cliente->email) ? strUpper($cliente->email) : 'Sin Datos...' ?></td>
                            </tr>
                            <tr>
                                <th scope="row">COMUNA</th>
                                <td><?= !empty($cliente->comuna_id) ? $cliente->comuna_id : 'Sin Datos...' ?></td>
                            </tr>
                            <tr>
                                <th scope="row">SECTOR</th>
                                <td><?= !empty($cliente->sector_id) ? $cliente->sector_id : 'Sin Datos...' ?></td>
                            </tr>
                            <tr>
                                <th scope="row">DIRECCION</th>
                                <td>
                                    <a href="<?= !empty($cliente->direccion) ? $cliente->direccion : '#' ?>" target="_blank"><i class="fas fa-map-marker-alt"></i> Abrir Maps</a>
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