<!-- Sidebar Navigation Left -->
<aside id="ms-side-nav" class="side-nav ms-aside-scrollable ms-aside-left">

  <!-- Logo -->
  <div class="logo-sn ms-d-block-lg">
    <a class="text-center" href="..\..\index.html"> <img src="<?= ASSETS_IMG ?>logo1.jpg" style="max-width: 250px;" alt="logo"> </a>
  </div>

  <!-- Navigation -->
  <ul class="accordion ms-main-aside fs-14" id="side-nav-accordion">

    <li class="menu-item active">
      <a href="<?= base_url('/') ?>" class="active">
        <span><i class="material-icons fs-16">widgets</i>Menu</span>
      </a>
    </li>
    <!-- Dashboard -->
    <li class="menu-item">
      <a href="#" class="has-chevron" data-toggle="collapse" data-target="#rutas" aria-expanded="false" aria-controls="rutas">
        <span><i class="material-icons fs-16">filter_list</i>Rutas </span>
      </a>
      <ul id="rutas" class="collapse" aria-labelledby="rutas" data-parent="#side-nav-accordion">
        <li> <a href="<?= base_url('rutas/nueva') ?>">Nueva Ruta</a> </li>
        <li> <a class="active" href="<?= base_url('rutas/listado') ?>">Listado de Rutas</a> </li>
      </ul>
    </li>
    <?php if (USUARIO_ROL == 1) : ?>
      <li class="menu-item">
        <a href="#" class="has-chevron" data-toggle="collapse" data-target="#ventas" aria-expanded="false" aria-controls="ventas">
          <span><i class="material-icons fs-16">filter_list</i>Ventas </span>
        </a>
        <ul id="ventas" class="collapse" aria-labelledby="ventas" data-parent="#side-nav-accordion">
          <li> <a href="<?= base_url('ventas/nueva') ?>">Nueva Venta</a> </li>
          <li> <a class="active" href="<?= base_url('ventas/listado') ?>">Listado de Ventas</a> </li>
        </ul>
      </li>
      <li class="menu-item">
        <a href="#" class="has-chevron" data-toggle="collapse" data-target="#clientes" aria-expanded="false" aria-controls="clientes">
          <span><i class="material-icons fs-16">filter_list</i>clientes </span>
        </a>
        <ul id="clientes" class="collapse" aria-labelledby="clientes" data-parent="#side-nav-accordion">
          <li> <a href="<?= base_url('clientes/nuevo') ?>">Nuevo Cliente</a> </li>
          <li> <a href="<?= base_url('clientes/listado') ?>">Listado de Clientes</a> </li>
        </ul>
      </li>
      <li class="menu-item" style="display: none;">
        <a href="#" class="has-chevron" data-toggle="collapse" data-target="#productos" aria-expanded="false" aria-controls="productos">
          <span><i class="material-icons fs-16">filter_list</i>productos </span>
        </a>
        <ul id="productos" class="collapse" aria-labelledby="productos" data-parent="#side-nav-accordion">
          <li> <a href="<?= base_url('productos/nuevo') ?>">Nuevo Producto</a> </li>
          <li> <a href="<?= base_url('productos/listado') ?>">Listado de Productos</a> </li>
        </ul>
      </li>
      <li class="menu-item">
        <a href="#" class="has-chevron" data-toggle="collapse" data-target="#deudas" aria-expanded="false" aria-controls="deudas">
          <span><i class="material-icons fs-16">filter_list</i>deudas </span>
        </a>
        <ul id="deudas" class="collapse" aria-labelledby="deudas" data-parent="#side-nav-accordion">
          <!-- <li> <a href="<?= base_url('deudas/nueva') ?>">Nueva Deuda</a> </li> -->
          <li> <a href="<?= base_url('deudas/listado') ?>">Listado de Deudas</a> </li>
        </ul>
      </li>
      <li class="menu-item">
        <a href="#" class="has-chevron" data-toggle="collapse" data-target="#usuarios" aria-expanded="false" aria-controls="usuarios">
          <span><i class="material-icons fs-16">filter_list</i>usuarios </span>
        </a>
        <ul id="usuarios" class="collapse" aria-labelledby="usuarios" data-parent="#side-nav-accordion">
          <li> <a href="<?= base_url('usuarios/nuevo') ?>">Nuevo Usuario</a> </li>
          <li> <a href="<?= base_url('usuarios/listado') ?>">Listado de Usuarios</a> </li>
        </ul>
      </li>

      <li class="menu-item">
        <a href="#" class="has-chevron" data-toggle="collapse" data-target="#sectores" aria-expanded="false" aria-controls="sectores">
          <span><i class="material-icons fs-16">filter_list</i>sectores</span>
        </a>
        <ul id="sectores" class="collapse" aria-labelledby="sectores" data-parent="#side-nav-accordion">
          <li> <a href="<?= base_url('sectores/nuevo') ?>">Nuevo Sector</a> </li>
          <li> <a href="<?= base_url('sectores/listado') ?>">Listado de Sectores</a> </li>
        </ul>
      </li>

      <li class="menu-item">
        <a href="<?= base_url('iconos') ?>">
          <span><i class="material-icons fs-16">filter_list</i>Iconos </span>
        </a>
      </li>
    <?php endif; ?>

  </ul>


</aside>