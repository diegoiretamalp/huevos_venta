<div class="ms-content-wrapper">
    <div class="row">
        <form class="w-100" action="<?= base_url('rutas/nueva') ?>" method="post" id="formulario">
            <div class="col-12">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="ms-card">
                            <div class="ms-card-header">
                                Información de La Ruta
                            </div>
                            <div class="card-body">
                                <input type="hidden" name="clientes_ruta" id="clientes_ruta">
                                <div class="row d-flex justify-content-center">
                                    <div class="col-12 col-md-6">
                                        <label for="total_cajas">Total Cajas Para Ruta</label>
                                        <input type="text" name="total_cajas" id="total_cajas" class="form-control" placeholder="Ingrese Total de Cajas...">
                                        <span class="invalid_total_cajas"></span>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label for="repartidor_id">Repartidor</label>
                                        <select name="repartidor_id" id="repartidor_id" class="form-control">
                                            <option value="0">Selecccionar</option>
                                            <?php if (!empty($repartidores)) : ?>
                                                <?php foreach ($repartidores as $repartidor) : ?>
                                                    <option value="<?= $repartidor->id ?>"><?= $repartidor->nombre ?></option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                        <span class="invalid_total_cajas"></span>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="fecha_ruta">Fecha de Ruta</label>
                                            <input type="date" id="fecha_ruta" placeholder="Fecha" aria-label="Search" class="form-control" autocomplete="off" name="fecha_ruta">
                                        </div>
                                        <span class="invalid_fecha_ruta"></span>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label for="observacion_ruta">Observación Ruta</label>
                                        <input class="form-control" type="text" placeholder="Ingrese Observacion..." name="observacion_ruta" id="observacion_ruta">
                                        <span id="invalid_observacion_ruta"></span>
                                    </div>

                                </div>
                                <div class="row d-flex justify-content-center">
                                    <button type="button" class="btn btn-success" id="btn_finalizar">Crear Ruta</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="row">
                    <div class="col-12">
                        <div class="ms-card">
                            <div class="ms-card-body">
                                <div class="row">
                                    <?php /*
                                    <div class="col-xl-3">
                                        <label for="region_id">Region</label>
                                        <select class="form-control" name="region_id" id="region_id">
                                            <!-- <option value="0">Todas</option> -->
                                            <?php if (!empty($regiones)) : ?>
                                                <?php foreach ($regiones as $region) : ?>
                                                    <option value="<?= $region->id ?>"><?= $region->nombre ?></option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                    <div class="col-xl-3">
                                        <label for="comuna_id">Comuna</label>
                                        <select class="form-control" name="comuna_id" id="comuna_id">
                                            <option value="0">Todas</option>
                                            <?php if (!empty($comunas)) : ?>
                                                <?php foreach ($comunas as $comuna) : ?>
                                                    <option region-data=<?= $comuna->region_id ?> value="<?= $comuna->id ?>"><?= $comuna->nombre ?></option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                    <!-- <div class="col-xl-3">
                                        <label for="sector_id">Sector</label>
                                        <select class="form-control" name="sector_id" id="sector_id">
                                            <option value="0">Todas</option>
                                            <?php if (!empty($sectores)) : ?>
                                                <?php foreach ($sectores as $sector) : ?>
                                                    <option comuna-data=<?= $sector->comuna_id ?> value="<?= $sector->id ?>"><?= $sector->nombre ?></option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                    </div> */ ?>
                                    <div class="col-xl-3">
                                        <label for="grupo_id">Grupos</label>
                                        <select class="form-control" name="grupo_id" id="grupo_id">
                                            <option value="0">Todas</option>
                                            <?php if (!empty($grupos)) : ?>
                                                <?php foreach ($grupos as $grupo) : ?>
                                                    <option value="<?= $grupo->id ?>"><?= !empty($grupo->nombre) ? $grupo->nombre : 'Sin Informacion' ?></option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                    <div class="col-xl-2 mt-auto">
                                        <button type="button" id="btn_cargar_clientes" class="btn btn-sm btn-secondary"> Cargar</button>
                                    </div>
                                    <!-- <div class="col-xl-2 d-flex justify-content-center align-content-center">
                                        <button type="button" id="btn_cargar_cliente" class="btn btn-sm btn-secondary">Cargar</button>
                                    </div> -->
                                </div>
                            </div>
                            <br>
                            <div>
                                <div class="row m-2" id="body_clientes">
                                    <!-- <div class="col-12 col-sm-6 col-md-4 col-xl-3">
                                        <div class="ms-card">
                                            <div class="ms-card-header text-center">
                                                <b class="p-3" style="position: absolute;">1</b>
                                                <b class="text-danger" style="margin-left: 90%; cursor: pointer;"><i class="fas fa-times-circle fa-2x"></i></b>
                                                <h6 class="text-center">Diego Retamal Pacheco</h6>
                                            </div>
                                            <div class="ms-card-body text-center">
                                                <h6>
                                                    <i class="far fa-money-bill-alt p-2"></i> Precio Favorito <b>$ 49.900</b>
                                                </h6>
                                                <h6>
                                                    <i class="fas fa-egg p-2"></i> Producto Favorito <b>Primera</b>
                                                </h6>
                                                <h6 class="text-danger">
                                                    <i class="far fa-money-bill-alt p-2"></i> Deuda Pendiente <b>$ 49.900</b>
                                                </h6>


                                                <div class="button-group2 d-flex justify-content-center">
                                                    <button type="button" onclick="VerDetalleCliente()" style="background-color: #374eae; color: white;">Ver Detalle</button>
                                                    <button type="button" onclick="VerDeudasCliente()" style="background-color: red; color: white;">Ver Deudas</button>
                                                </div>
                                            </div>
                                            <div class="ms-card-footer text-disabled d-flex">
                                                <div class="ms-card-options">
                                                    <i class="fas fa-box    "></i> 982
                                                </div>
                                                <div class="ms-card-options" style="color: green;">
                                                    <i class="fas fa-dollar-sign    "></i> + 785
                                                </div>
                                                <div class="ms-card-options">
                                                    <a href="#" target="_blank"><i class="fas fa-map-marked-alt"></i>Ver Maps</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>

</div>

<div class="modal fade" id="modal_deudas" tabindex="-1" role="dialog" aria-labelledby="modal-1">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h3 class="modal-title has-icon ms-icon-round "><i class="fa fa-info-circle fa-2x" style="color: #374eae;" aria-hidden="true"></i> DEUDAS DEL CLIENTE</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>

            <div class="modal-body">
                <div class="alert alert-outline" role="alert">
                    <table class="table table-hover w-100 dataTable no-footer" id="table_deudas">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Monto Deuda</th>
                                <th>Monto Pagado</th>
                                <th>Fecha Deuda</th>
                            </tr>
                        </thead>
                        <tbody id="tbody_deudas">
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Cerrar</button>
            </div>

        </div>
    </div>
</div>