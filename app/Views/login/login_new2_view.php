<?php
$session = session();
$errores = $session->getFlashdata('errores');

?>


<main class="main-content  mt-0">
  <div class="page-header align-items-start min-vh-100" style="background-image: url('https://images.unsplash.com/photo-1497294815431-9365093b7331?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1950&q=80');">
    <span class="mask bg-gradient-dark opacity-6"></span>
    <div class="container my-auto">
      <div class="row">
        <div class="col-lg-4 col-md-8 col-12 mx-auto">
          <div class="card z-index-0 fadeIn3 fadeInBottom">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">Iniciar Sesion</h4>
                <div class="row mt-3 d-flex justify-content-center">
                  <!-- <div class="col-2 text-center ms-auto">
                      <a class="btn btn-link px-3" href="javascript:;">
                        <i class="fa fa-facebook text-white text-lg"></i>
                      </a>
                    </div>
                    <div class="col-2 text-center px-1">
                      <a class="btn btn-link px-3" href="javascript:;">
                        <i class="fa fa-github text-white text-lg"></i>
                      </a>
                    </div> -->
                  <!-- <div class="col-2 text-center">
                    <a class="btn btn-link px-3" href="javascript:;">
                      <i class="fa fa-google text-white text-lg"></i>
                    </a>
                  </div> -->
                </div>
              </div>
            </div>
            <div class="card-body">
              <form action="<?= base_url('login') ?>" method="post" id="formulario" autocomplete="off">
                <div class="input-group input-group-outline my-3">
                  <label class="form-label">R.U.T</label>
                  <input type="text" id="rut" name="rut" class="form-control" autocomplete="FALSE">
                </div>
                <div class="input-group input-group-outline mb-3">
                  <label class="form-label">Clave</label>
                  <input type="password" id="password" name="password" class="form-control" autocomplete="FALSE">
                </div>
                <!-- <div class="form-check form-switch d-flex align-items-center mb-3">
                    <input class="form-check-input" type="checkbox" id="rememberMe">
                    <label class="form-check-label mb-0 ms-2" for="rememberMe">Remember me</label>
                  </div> -->
                <div class="text-center">
                  <button type="button" class="btn bg-gradient-primary w-100 my-4 mb-2" id="iniciar_sesion">Iniciar Sesion</button>
                </div>
                <p class="mt-4 text-sm text-center">
                  No tienes cuenta?
                  <a href="<?= base_url('registro') ?>" class="text-primary text-gradient font-weight-bold">Registrarse</a>
                </p>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</main>