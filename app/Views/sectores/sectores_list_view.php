<div class="ms-content-wrapper">
    <div class="row">
        <div class="col-md-12 col-xl-6">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb pl-0">
                    <li class="breadcrumb-item"><a href="<?= base_url('/') ?>"><i class="material-icons">home</i> Menu</a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url('sectores/listado') ?>">Listado Sectores</a></li>
                </ol>
            </nav>
        </div>
        <div class="col-md-12 col-xl-6 d-flex justify-content-end">
            <a class="btn btn-pill btn-info has-icon d-flex align-items-center" href="<?= base_url('sectores/nuevo') ?>">
                <i class="fas fa-user-circle" style="font-size: 24px;"></i>
                Nuevo Sector
            </a>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-12 table-responsive">
            <table id="data-table" class="table table-hover w-100 dataTable no-footer">
                <thead>
                    <th>Nombre</th>
                    <th>Comuna</th>
                    <th>Accion</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($sectores)) : ?>
                        <?php foreach ($sectores as $sector) : ?>
                            <tr>
                                <td><?= $sector->nombre ?></td>
                                <td>
                                    <?php foreach ($comunas as $comuna) : ?>
                                        <?php if ($comuna->id == $sector->comuna_id) : ?>
                                            <?= $comuna->nombre ?>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </td>
                                <td style="width: 10%;">
                                    <a class="btn btn-sm btn-secondary mt-0" href="<?= base_url('sectores/editar/' . $sector->id) ?>"> <i class="fas fa-edit"></i> Editar</a>
                                    <button type="button" onclick="EliminarSector(<?= $sector->id ?>)" class="btn btn-sm btn-danger btn_deleted "><i class="fa fa-trash"></i> Eliminar
                                    </button>

                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>