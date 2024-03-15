<main class="main-content  mt-0">
    <section>
        <div class="page-header min-vh-100">
            <div class="container">
                <div class="row">
                    <div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 start-0 text-center justify-content-center flex-column">
                        <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center" style="background-image: url('<?= ASSETS ?>assets2/img/illustrations/illustration-signup.jpg'); background-size: cover;">
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column ms-auto me-auto ms-lg-auto me-lg-5">
                        <div class="card card-plain">
                            <div class="card-header">
                                <h4 class="font-weight-bolder">Registro de Empresa</h4>
                                <p class="mb-0">Ingresa los datos requeridos para registrarse</p>
                            </div>
                            <div class="card-body">
                                <form action="<?= base_url('registro') ?>" method="post" id="formulario" autocomplete="off">
                                    <div class="input-group input-group-outline">
                                        <label class="form-label" for="rut">R.U.T.</label>
                                        <input type="text" class="form-control" id="rut" name="rut">
                                    </div>
                                    <span class="text-danger" style="font-size: 14px;" id="invalid_rut"></span>

                                    <br>
                                    <div class="input-group input-group-outline">
                                        <label class="form-label">RAZON SOCIAL</label>
                                        <input type="text" class="form-control" id="razon_social" name="razon_social">
                                    </div>
                                    <span class="text-danger" id="invalid_razon_social" style="font-size: 14px;"></span>
                                    <br>

                                    <div class="input-group input-group-outline">
                                        <label class="form-label">EMAIL</label>
                                        <input type="text" id="email" name="email" class="form-control">
                                    </div>
                                    <span class="text-danger" id="invalid_email" style="font-size: 14px;"></span>
                                    <br>

                                    <div class="input-group input-group-outline">
                                        <label class="form-label">CONTRASEÑA</label>
                                        <input type="password" id="password" name="password" class="form-control">
                                    </div>
                                    <span class="text-danger" id="invalid_password" style="font-size: 14px;"></span>
                                    <br>

                                    <div class="input-group input-group-outline">
                                        <label class="form-label">CONFIRMAR CONTRASEÑA</label>
                                        <input type="password" id="password_confirm" name="password_confirm" class="form-control">
                                    </div>
                                    <span class="text-danger" id="invalid_password_confirm" style="font-size: 14px;"></span>
                                    <br>
                                    <br>

                                    <div class="form-check form-check-info text-start ps-0">
                                        <input class="form-check-input" type="checkbox" id="terminos_condiciones" name="terminos_condiciones">
                                        <label class="form-check-label" id="terminos_condiciones_text" for="terminos_condiciones">
                                            Acepto los <a href="javascript:;" class="text-dark font-weight-bolder">Términos y Condiciones</a>
                                        </label>
                                    </div>
                                    <div class="text-center">
                                        <button type="button" id="registrarse" class="btn btn-lg bg-gradient-primary btn-lg w-100 mt-4 mb-0">Registrarse</button>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                <p class="mb-2 text-sm mx-auto">
                                    Ya tienes una cuenta?
                                    <a href="<?= base_url('login') ?>" class="text-primary text-gradient font-weight-bold">Iniciar Sesion</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>