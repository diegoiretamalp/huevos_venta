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
        <div class="col-12 table-responsive">
            <table id="data-table" class="table table-hover w-100 dataTable no-footer">
                <thead>
                    <tr role="row">
                        <th>Rut a Facturar</th>
                        <th>Nombre Negocio</th>
                        <th>Nombre</th>
                        <th>Apellido Paterno</th>
                        <th>Precio Venta</th>
                        <th>Categoria</th>
                        <th>Color Huevo</th>
                        <th>Celular</th>
                        <th>Sector</th>
                        <th>Direccion</th>
                        <th>Accion</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($clientes)) : ?>
                        <?php foreach ($clientes as $cliente) : ?>
                            <tr>
                                <td><?= $cliente->rut_factura ?></td>
                                <td><?= $cliente->nombre_negocio ?></td>
                                <td><?= $cliente->nombre ?></td>
                                <td><?= $cliente->apellido_paterno  ?></td>
                                <td><?= $cliente->precio_favorito?></td>
                                <td><?= $cliente->nombre_producto?></td>
                                <td><?= $cliente->tipo_huevo?></td>
                                <td><?= $cliente->celular ?></td>
                                <td><?= $cliente->nombre_sector ?></td>
                                <td><?= $cliente->direccion ?></td>
                                <td style="width: 10%;">
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