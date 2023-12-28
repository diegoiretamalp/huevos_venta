<div class="ms-content-wrapper">

    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb pl-0">
                    <li class="breadcrumb-item"><a href="<?= base_url('/') ?>"><i class="material-icons">home</i> Menu</a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url('grupos/listado') ?>">Listado Grupos</a></li>
                </ol>
            </nav>
        </div>
        <div class="col-12">
            <div class="card card-body table-responsive">
                <table id="data-table" class="table table-hover w-100 dataTable no-footer">
                    <thead>
                        <tr role="row">
                            <th>ID</th>
                            <th>NOMBRE</th>
                            <th>CLIENTES</th>
                            <th>ESTADO</th>
                            <th class="text-center" style="white-space: nowrap;">ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($grupos)) : ?>
                            <?php foreach ($grupos as $grupo) : ?>
                                <tr>
                                    <td><?= !empty($grupo->id) ? $grupo->id : 'Sin Información' ?></td>
                                    <td><?= !empty($grupo->nombre) ? strUpper($grupo->nombre) : 'Sin Información' ?></td>
                                    <td><?= !empty($grupo->clientes) ? strUpper($grupo->clientes) : 'Sin Información' ?></td>
                                    <td><?= !empty($grupo->estado) ? ($grupo->estado == 1 ? 'ACTIVO' : 'INACTIVO') : '' ?></td>
                                    <td style="white-space: nowrap;" class="text-center">
                                        <a href="<?= base_url('grupos/editar/' . $grupo->id) ?>" class="btn btn-sm btn-info"><i class="fas fa-edit"></i> Editar Grupo</a>
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