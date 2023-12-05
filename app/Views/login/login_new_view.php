<?php
$session = session();
$errores = $session->getFlashdata('errores');

?>

<!-- Body Content Wrapper -->
<div class="ms-content-wrapper ms-auth">

  <div class="ms-auth-container">
    <div class="ms-auth-col">
      <div class="ms-auth-bg">
      </div>
    </div>
    <div class="ms-auth-col">
      <div class="ms-auth-form">
        <form action="<?= base_url('login') ?>" method="post" id="formulario" autocomplete="off">
          <h1>Inicio de Sesión</h1>
          <div class="mb-4">
            <div class="form-group">
              <label for="rut">Rut</label>
              <input type="text" class="form-control" id="rut" name="rut" placeholder="Ej: 19.345.400-3">
              <span id="invalid_rut" class="text-danger" ></span>
            </div>
          </div>
          <div class="mb-4">
            <div class="form-group">
              <label for="password">Contraseña</label>
              <input type="password" class="form-control" id="password" name="password" placeholder="Ingrese su contraseña">
              <span id="invalid_password" class="text-danger" ></span>
            </div>
          </div>
          <button class="btn btn-pill btn-primary mt-4 d-block w-100" id="iniciar_sesion" type="button"><i class="far fa-user-circle pr-2" style="font-size: 18px;"></i> Iniciar Sesion</button>
          <span class="d-block text-center my-4">O</span>
          <a class="btn btn-pill btn-danger mt-4 d-block w-100" href=" <?= base_url('login/restablecer-password') ?>"><i class="fas fa-key pr-2" style="font-size:18px ;"></i> Restablecer Contraseña</a>
        </form>
      </div>
    </div>
  </div>
</div>