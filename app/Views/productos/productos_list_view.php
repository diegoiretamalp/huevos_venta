<div class="ms-content-wrapper">
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb pl-0">
                    <li class="breadcrumb-item"><a href="<?= base_url('/') ?>"><i class="material-icons">home</i> Menu</a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url('productos/listado') ?>">Listado Productos</a></li>
                </ol>
            </nav>
        </div>
        <div class="col-12 table-responsive">
            <table id="data-table" class="table table-hover w-100 dataTable no-footer">
                <thead>
                    <tr role="row">
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Descripcion</th>
                        <th>Stock</th>
                        <th>Precio</th>
                        <th>Categoría</th>
                        <th>Creado</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($productos): $count = 0;  ?>
                        <?php foreach ($productos as $producto) : $count ++;?>
                            <tr>
                                <td><?= $count ?></td>
                                <td><?= !empty($producto->nombre) ? $producto->nombre : 'Sin Datos...' ?></td>
                                <td><?= !empty($producto->descripcion) ? $producto->descripcion : 'Sin Datos...' ?></td>
                                <td><?= !empty($producto->stock) ? $producto->stock : 'Sin Datos...' ?></td>
                                <td><?= !empty($producto->precio) ? $producto->precio : 'Sin Datos...' ?></td>
                                <td><?= !empty($producto->categoria_id) ? $producto->categoria_id : 'Sin Datos...' ?></td>
                                <td><?= !empty($producto->created_at) ? $producto->created_at : 'Sin Datos...' ?></td>
                                <td>
                                    <a class="btn btn-sm btn-secondary mt-0" href="<?= base_url('productos/editar/' . $producto->id) ?>"> <i class="fas fa-edit"></i> Editar</a>
                                </td>
                            </tr>
                        <?php endforeach;?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>