<div class="container">
    <br>
    <div class="ms-card">
        <div class="ms-card-body">
            <form action="<?= isset($action) ? $action : '' ?>" method="post">
                <div class="form-row">
                    <div class="col-md-3 mb-3">
                    </div>
                    <div class="col-md-6 mb-6">
                        <div class="form-group">
                            <label for="password">Contraseña Actual <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="password" id="password" name="password" class="form-control" placeholder="Ingrese contraseña actual...">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fa   fa-unlock-alt"></span>
                                    </div>
                                </div>
                            </div>
                            <small id="invalid_password_actual" class="text-danger"></small>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label for="nueva_password">Nueva Contraseña <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="nueva_password" id="nueva_password" name="nueva_password" class="form-control" placeholder="Ingrese su nueva contraseña ...">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fa fa-lock"></span>
                                    </div>
                                </div>
                            </div>
                            <small id="invalid_password_nueva" class="text-danger"></small>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label for="confirmar_password">Confirmar Contraseña <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="confirmar_password" id="confirmar_password" name="confirmar_password" class="form-control" placeholder="Confirme su contraseña ...">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fa fa-lock"></span>
                                    </div>
                                </div>
                            </div>
                            <small id="invalid_password_confirmar" class="text-danger"></small>
                        </div>
                        <div class="social-auth-links text-center mt-2 mb-3">
                            <div class="col-12">
                                <button type="button" class="btn btn-pill btn-primary mt-4 d-block w-100"> Cambiar Contraseña <i class="fa fa-key "></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                    </div>
                </div>
            </form>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>