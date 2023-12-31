<div class="ms-content-wrapper">
    <div class="row">
        <div class="col-md-12 col-xl-6">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb pl-0">
                    <li class="breadcrumb-item"><a href="<?= base_url('/') ?>"><i class="material-icons">home</i> Menu</a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url('usuarios/listado') ?>">Listado Usuarios</a></li>
                </ol>
            </nav>
        </div>
        <div class="col-md-12 col-xl-6 d-flex justify-content-end">
            <a class="btn btn-pill btn-info has-icon d-flex align-items-center" href="<?= base_url('usuarios/nuevo') ?>">
                <i class="fas fa-user-circle" style="font-size: 24px;"></i>
                Nuevo Usuario
            </a>
        </div>
    </div>
    <br>

    <div class="row">
        <div class="col-12 card card-body table-responsive">
            <table id="data-table" class="table table-hover w-100 dataTable no-footer">
                <thead>
                    <tr role="row">
                        <th>Nombre</th>
                        <th>Rut</th>
                        <th>Celular</th>
                        <th>Email</th>
                        <th>Direccion</th>
                        <th>Perfil</th>
                        <th>Accion</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($usuarios)) : ?>
                        <?php foreach ($usuarios as $usuario) : ?>
                            <tr id="row_<?= $usuario->id ?>">
                                <td><?= !empty($usuario->nombre_usuario) ? $usuario->nombre_usuario : 'Sin Datos...' ?></td>
                                <td><?= !empty($usuario->rut) ? $usuario->rut : 'Sin Datos...' ?></td>
                                <td><?= !empty($usuario->celular) ? $usuario->celular : 'Sin Datos...' ?></td>
                                <td><?= !empty($usuario->email) ? $usuario->email : 'Sin Datos...' ?></td>
                                <td><?= !empty($usuario->direccion) ? $usuario->direccion : 'Sin Datos...' ?></td>
                                <td><?= !empty($usuario->nombre_perfil) ? $usuario->nombre_perfil : 'Sin Datos...' ?></td>
                                <td>
                                    <a class="btn btn-sm btn-secondary mt-0" href="<?= base_url('usuarios/editar/' . $usuario->id) ?>"> <i class="fas fa-edit fs-16"></i> Editar</a>
                                    <button type="button" onclick="EliminarUsuario(<?= $usuario->id ?>)" class="btn btn-sm btn-danger btn_deleted mt-0 "><i class="fa fa-trash"></i> Eliminar</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>