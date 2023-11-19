<?php 
$session = session();
$errores = $session->getFlashdata('errores');

?>

<main class="body-content">
<!-- Body Content Wrapper -->
<div class="ms-content-wrapper ms-auth">

  <div class="ms-auth-container">
    <div class="ms-auth-col">
      <div class="ms-auth-bg">
      </div>
    </div>
    <div class="ms-auth-col">
      <div class="ms-auth-form">
        <form class="needs-validation" novalidate="">
          <h1>Inicio de Sesión</h1>
          <div class="mb-4">
            <label for="rut">Rut</label>
            <div class="input-group">
              <input type="text" class="form-control" id="rut" placeholder="Ej: 19.345.400-3" required="">
              <div class="invalid_rut"></div>
            </div>
          </div>
          <div class="mb-4">
            <label for="password">Contraseña</label>
            <div class="input-group">
              <input type="password" class="form-control" id="password" placeholder="Ingrese su contraseña" required="">
              <div class="invalid_password"></div>
            </div>
          </div>
          <button class="btn btn-pill btn-primary mt-4 d-block w-100" id="iniciar_sesion" type="submit">Iniciar Sesion <i class="far fa-user-circle "></i></button>
          <span class="d-block text-center my-4">O</span>
          <a class="btn btn-pill btn-danger mt-4 d-block w-100"" href="<?= base_url('login/restablecer-password') ?>"> <i></i> Restablecer Contraseña? <i class="fas fa-edit"></i></a> 
        </form>
      </div>
    </div>
  </div>
</div>

</main>