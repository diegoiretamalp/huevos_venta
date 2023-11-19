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
                                <label for="email">Correo electrónico <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="email" id="email" name="email" class="form-control" placeholder="Ingrese correo electrónico...">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-envelope"></span>
                                        </div>
                                    </div>
                                </div>
                                <small id="invalid_email" class="text-danger"></small>
                            </div>
                            <hr>
                            <div class="social-auth-links text-center mt-2 mb-3">
                                <div class="col-12">
                                    <button type="button" class="btn btn-pill btn-primary mt-4 d-block w-100"> Restablecer Contraseña <i class="fa fa-history "></i></button>
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