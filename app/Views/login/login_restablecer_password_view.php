<div class="container">
    <br>
    <div class="ms-card">
        <div class="ms-card-header">
            <h1 class="text-center">
                Restablecimiento de Contraseña
            </h1>
        </div>
        <div class="ms-card-body">
            <form action="<?= isset($action) ? $action : '' ?>" method="post">
                <div class="form-row">
                    <div class="col-md-3 mb-3">
                    </div>
                    <div class="col-md-6 mb-6">
                        <div class="form-group">
                            <label for="rut">R.U.T. <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="text" id="rut" name="rut" class="form-control" placeholder="Ingrese R.U.T.">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-envelope"></span>
                                    </div>
                                </div>
                            </div>
                            <span id="invalid_rut" class="text-danger"></span>
                        </div>
                        <hr>
                        <div class="social-auth-links text-center mt-2 mb-3">
                            <div class="col-12">
                                <button type="submit" class="btn btn-pill btn-primary mt-4 d-block w-100"> Restablecer Contraseña <i class="fa fa-history "></i></button>
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
</div>