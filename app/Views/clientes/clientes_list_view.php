<div class="ms-content-wrapper">
    <div class="row">
        <div class="col-md-12 col-xl-6">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb pl-0">
                    <li class="breadcrumb-item"><a href="<?= base_url('/') ?>"><i class="material-icons">home</i> Menu</a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url('clientes/listado') ?>">Listado Clientes</a></li>
                </ol>
            </nav>
        </div>
        <div class="col-md-12 col-xl-6 d-flex justify-content-end">
            <a class="btn btn-pill btn-info has-icon d-flex align-items-center" href="<?= base_url('clientes/nuevo') ?>">
                <i class="fas fa-user-circle" style="font-size: 24px;"></i>
                Nuevo Cliente
            </a>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="card card-body ">
            <div class="col-12 table-responsive">
                <table id="data-table" class="table table-hover w-100 dataTable no-footer">
                    <thead>
                        <tr role="row">
                            <th style="white-space: nowrap;">ID</th>
                            <th style="white-space: nowrap;">Rut a Facturar</th>
                            <th >Nombre Completo</th>
                            <th style="white-space: nowrap;">Favoritos</th>
                            <th style="white-space: nowrap;">CARTERA</th>
                            <th style="white-space: nowrap;">Celular</th>
                            <th style="white-space: nowrap;">Sector</th>
                            <th style="white-space: nowrap;">Direccion</th>
                            <th style="white-space: nowrap;">Accion</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($clientes)) : ?>
                            <?php foreach ($clientes as $cliente) : ?>
                                <tr id="row_<?= $cliente->id?>">
                                    <td style="white-space: nowrap;"><?= $cliente->id ?></td>
                                    <td style="white-space: nowrap;"><?= !empty($cliente->rut_factura) ? formateaRut($cliente->rut_factura) : 'Sin Información' ?></td>
                                    <td style="white-space: nowrap;"><?= !empty($cliente->nombre) ? (strUpper($cliente->nombre) . (!empty($cliente->apellido_paterno) ? ' ' . strUpper($cliente->apellido_paterno) : '') . (!empty($cliente->apellido_materno) ? ' ' . strUpper($cliente->apellido_paterno) : '')) : 'Sin Información' ?></td>
                                    <td style="white-space: nowrap;">
                                        <p>
                                            Precio Favorito: <?= !empty($cliente->precio_favorito) ? formatear_numero($cliente->precio_favorito) : 'Sin Favorito' ?><br>
                                            Producto Favorito: <?= !empty($cliente->nombre_producto) ? strUpper($cliente->nombre_producto) : 'Sin Favorito' ?><br>
                                            Calibre Favorito: <?= !empty($cliente->tipo_huevo) ? ($cliente->tipo_huevo == 'b' ? 'BLANCO' : 'COLOR') : 'Sin Favorito' ?>
                                        </p>
                                    </td>
                                    <td style="white-space: nowrap;">
                                        <p>
                                            Total Compra: <?= !empty($cliente->total_compra) ? formatear_numero($cliente->total_compra) : '$0' ?><br>
                                            Total Pagado: <?= !empty($cliente->total_pagado) ? formatear_numero($cliente->total_pagado) : '$0' ?><br>
                                            Total Deuda: <?= !empty($cliente->total_deuda) ? formatear_numero($cliente->total_deuda) : '$0' ?><br>
                                            N° Compras: <?= !empty($cliente->cantidad_compras) ? $cliente->cantidad_compras : '0' ?>
                                        </p>
                                    </td>
                                    <!-- <td style="white-space: nowrap;"><?= !empty($cliente->nombre_negocio) ? strUpper($cliente->nombre_negocio) : 'Sin Información' ?></td> -->
                                    <td style="white-space: nowrap;"><?= !empty($cliente->celular) ? $cliente->celular : 'Sin Información' ?></td>
                                    <td style="white-space: nowrap;"><?= !empty($cliente->nombre_sector) ? strUpper($cliente->nombre_sector) : 'Sin Información' ?></td>
                                    <td style="white-space: nowrap;"><?= !empty($cliente->direccion) ? strUpper($cliente->direccion) : 'Sin Información' ?></td>
                                    <td style="white-space: nowrap;">
                                        <div class="btn-group btn-group-toggle">
                                            <a class="btn btn-sm btn-secondary mt-0" href="<?= base_url('clientes/ver/' . $cliente->id) ?>"> <i class="fas fa-eye"></i> Ver</a>
                                            <a class="btn btn-sm btn-secondary mt-0" href="<?= base_url('clientes/editar/' . $cliente->id) ?>"> <i class="fas fa-edit"></i> Editar</a>
                                            <button type="button" onclick="EliminarCliente(<?= $cliente->id ?>)" class="btn btn-sm btn-danger btn_deleted mt-0 "><i class="fa fa-trash"></i> Eliminar</button>
                                        </div>
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