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
                                        <label for="fecha_ruta">Fecha de Ruta</label>
                                        <div class="input-group date" id="fecha_rutadate" data-target-input="nearest" readonly>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                            </div>
                                            <input type="text" id="fecha_ruta" autocomplete="off" name="fecha_ruta" data-target="#fecha_rutadate" data-toggle="datetimepicker" class="form-control datepicker" placeholder="Fecha Inicial...">
                                        </div>
                                        <span class="invalid_fecha_ruta"></span>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label for="observacion_ruta">Observación Ruta</label>
                                        <input class="form-control" type="text" placeholder="Ingrese Observacion..." name="obserbacion_ruta" id="observacion_ruta">
                                        <span id="invalid_observacion_ruta"></span>
                                    </div>

                                </div>
                                <div class="row d-flex justify-content-center">
                                    <button type="button" class="btn btn-success" id="btn_finalizar">Finalizar</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <hr>

            <div class="col-12">
                <div class="row">
                    <div class="col-12">
                        <div class="ms-card">
                            <div class="ms-card-body">
                                <div class="row">
                                    <div class="col-xl-4 pb-3">
                                        <label for="comuna_id">Comuna</label>
                                        <select class="form-control" name="comuna_id" id="comuna_id">
                                            <option value="0">Todas</option>
                                            <?php if (!empty($comunas)) : ?>
                                                <?php foreach ($comunas as $comuna) : ?>
                                                    <option value="<?= $comuna->id ?>"><?= $comuna->nombre ?></option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                    <div class="col-xl-2 d-flex justify-content-center align-content-center">
                                        <button type="button" id="btn_cargar_clientes" class="btn btn-sm btn-secondary">Cargar</button>
                                    </div>
                                    <div class="col-xl-4">
                                        <label for="cliente_id">Seleccionar Clientes</label>
                                        <select class="form-control" name="cliente_id" id="cliente_id">
                                            <option value="0">Seleccionar</option>
                                            <?php if (!empty($clientes)) : ?>
                                                <?php foreach ($clientes as $cliente) : ?>
                                                    <option value="<?= $cliente->id ?>"><?= $cliente->nombre . ' ' . $cliente->apellido_paterno . ' ' . $cliente->apellido_materno ?></option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                    </div>

                                    <div class="col-xl-2 d-flex justify-content-center align-content-center">
                                        <button type="button" id="btn_cargar_cliente" class="btn btn-sm btn-secondary">Cargar</button>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-xl-12">
                                    <ul class="ms-activity-log">
                                    </ul>
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
                <h3 class="modal-title has-icon ms-icon-round "><i class="flaticon-alert-1 bg-primary text-white"></i> DEUDAS DEL CLIENTE!</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>

            <div class="modal-body">
                <div class="alert alert-danger alert-outline" role="alert">
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