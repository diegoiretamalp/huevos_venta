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
                            <th style="white-space: nowrap;">Rut a Facturar</th>
                            <th style="white-space: nowrap;">Nombre Negocio</th>
                            <th style="white-space: nowrap;">Nombre</th>
                            <th style="white-space: nowrap;">Apellido Paterno</th>
                            <th style="white-space: nowrap;">Precio Venta</th>
                            <th style="white-space: nowrap;">Categoria</th>
                            <th style="white-space: nowrap;">Color Huevo</th>
                            <th style="white-space: nowrap;">Celular</th>
                            <th style="white-space: nowrap;">Sector</th>
                            <th style="white-space: nowrap;">Direccion</th>
                            <th style="white-space: nowrap;">Accion</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($clientes)) : ?>
                            <?php foreach ($clientes as $cliente) : ?>
                                <tr>
                                    <td style="white-space: nowrap;"><?= !empty($cliente->rut_factura) ? formateaRut($cliente->rut_factura) : 'Sin Información' ?></td>
                                    <td style="white-space: nowrap;"><?= !empty($cliente->nombre_negocio) ? strUpper($cliente->nombre_negocio) : 'Sin Información' ?></td>
                                    <td style="white-space: nowrap;"><?= !empty($cliente->nombre) ? strUpper($cliente->nombre) : 'Sin Información' ?></td>
                                    <td style="white-space: nowrap;"><?= !empty($cliente->apellido_paterno) ? strUpper($cliente->apellido_paterno) : 'Sin Información' ?></td>
                                    <td style="white-space: nowrap;"><?= !empty($cliente->precio_favorito) ? formatear_miles($cliente->precio_favorito) : '$0' ?></td>
                                    <td style="white-space: nowrap;"><?= !empty($cliente->nombre_producto) ? strUpper($cliente->nombre_producto) : '$0' ?></td>
                                    <td style="white-space: nowrap;"><?= !empty($cliente->tipo_huevo) ? ($cliente->tipo_huevo == 'b' ? 'BLANCO' : 'COLOR') : 'Sin Información' ?></td>
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