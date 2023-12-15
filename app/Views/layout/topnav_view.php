 <!-- Navigation Bar -->
 <nav class="navbar ms-navbar" style="background-color: black;">

   <div class="ms-aside-toggler ms-toggler pl-0" data-target="#ms-side-nav" data-toggle="slideLeft">
     <span class="ms-toggler-bar bg-primary"></span>
     <span class="ms-toggler-bar bg-primary"></span>
     <span class="ms-toggler-bar bg-primary"></span>
   </div>
   <h1 class="text-white"><?= !empty($title) ? $title : '' ?></h1>

   <div class="logo-sn logo-sm ms-d-block-sm">
     <a class="pl-0 ml-0 text-center navbar-brand mr-0" href="..\..\index.html"><img src="..\..\assets\img\logo-sm-dark.png" alt="logo"> </a>
   </div>

   <ul class="ms-nav-list ms-inline mb-0" id="ms-nav-options">
     <li class="ms-nav-item dropdown">
       <a class="text-white" href="#" id="rutasDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-route fa-2x pr-2 "></i> Rutas</a>
       <ul class="dropdown-menu dropdown-menu-right user-dropdown" aria-labelledby="rutasDropdown">
         <li class="dropdown-menu-footer">
           <a class="media fs-14 p-2" href="<?= base_url('rutas/nueva') ?>"> <span><i class="fa fa-plus-circle pr-2" aria-hidden="true"></i> Nueva Ruta</span> </a>
           <a class="media fs-14 p-2" href="<?= base_url('rutas/listado') ?>"> <span><i class="fas fa-list pr-2"></i> Listado Rutas</span> </a>
         </li>
       </ul>
     </li>
     <?php if (USUARIO_ROL < 4) : ?>
       <li class="ms-nav-item dropdown">
         <a class="text-white" href="#" id="ventasDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-hand-holding-usd pr-2" style="font-size: 26px;"></i> Ventas</a>
         <ul class="dropdown-menu dropdown-menu-right user-dropdown" aria-labelledby="ventasDropdown">
           <li class="dropdown-menu-footer">
             <a class="media fs-14 p-2" href="<?= base_url('ventas/nuevo') ?>"> <span><i class="fa fa-plus-circle pr-2" aria-hidden="true"></i> Nueva Venta</span> </a>
             <a class="media fs-14 p-2" href="<?= base_url('ventas/listado') ?>"> <span><i class="fas fa-list pr-2"></i> Listado Ventas</span> </a>
           </li>
         </ul>
       </li>
       <li class="ms-nav-item dropdown">
         <a class="text-white" href="#" id="clientesDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-users pr-2" style="font-size: 26px;"></i> Clientes</a>
         <ul class="dropdown-menu dropdown-menu-right user-dropdown" aria-labelledby="clientesDropdown">
           <li class="dropdown-menu-footer">
             <a class="media fs-14 p-2" href="<?= base_url('clientes/nuevo') ?>"> <span><i class="fa fa-plus-circle pr-2" aria-hidden="true"></i> Nuevo Cliente</span> </a>
             <a class="media fs-14 p-2" href="<?= base_url('clientes/listado') ?>"> <span><i class="fas fa-list pr-2"></i> Listado Clientes</span> </a>
           </li>
         </ul>
       </li>
     <?php endif; ?>
     <?php if (USUARIO_ROL == 1) : ?>
       <li class="ms-nav-item dropdown">
         <a class="text-white" href="#" id="usuariosDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-users pr-2" style="font-size: 26px;"></i> Usuarios</a>
         <ul class="dropdown-menu dropdown-menu-right user-dropdown" aria-labelledby="usuariosDropdown">
           <li class="dropdown-menu-footer">
             <a class="media fs-14 p-2" href="<?= base_url('usuarios/nuevo') ?>"> <span><i class="fa fa-plus-circle pr-2" aria-hidden="true"></i> Nuevo Usuario</span> </a>
             <a class="media fs-14 p-2" href="<?= base_url('usuarios/listado') ?>"> <span><i class="fas fa-list pr-2"></i> Listado Usuarios</span> </a>
           </li>
         </ul>
       </li>
     <?php endif; ?>

     <li class="ms-nav-item">
       <a class="text-white" href="<?= base_url('logout') ?>"><i class="fas fa-door-open pr-2" style="font-size: 26px;"></i> Cerrar Sesion</a>
     </li>
     <!-- 

     <li class="ms-nav-item ms-nav-user dropdown">
       <a href="#" id="userDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <img class="ms-user-img ms-img-round float-right" src="..\..\assets\img\people\people-5.jpg" alt="people"> </a>
       <ul class="dropdown-menu dropdown-menu-right user-dropdown" aria-labelledby="userDropdown">
         <li class="dropdown-menu-header">
           <h6 class="dropdown-header ms-inline m-0"><span class="text-disabled">Welcome, Anny Farisha</span></h6>
         </li>
         <li class="dropdown-divider"></li>
         <li class="ms-dropdown-list">
           <a class="media fs-14 p-2" href="..\prebuilt-pages\user-profile.html"> <span><i class="flaticon-user mr-2"></i> Profile</span> </a>
           <a class="media fs-14 p-2" href="..\apps\email.html"> <span><i class="flaticon-mail mr-2"></i> Inbox</span> <span class="badge badge-pill badge-info">3</span> </a>
           <a class="media fs-14 p-2" href="..\prebuilt-pages\user-profile.html"> <span><i class="flaticon-gear mr-2"></i> Account Settings</span> </a>
         </li>
         <li class="dropdown-divider"></li>
         <li class="dropdown-menu-footer">
           <a class="media fs-14 p-2" href="..\prebuilt-pages\lock-screen.html"> <span><i class="flaticon-security mr-2"></i> Lock</span> </a>
         </li>
         <li class="dropdown-menu-footer">
           <a class="media fs-14 p-2" href="..\prebuilt-pages\default-login.html"> <span><i class="flaticon-shut-down mr-2"></i> Logout</span> </a>
         </li>
       </ul>
     </li> -->
   </ul>

   <div class="ms-toggler ms-d-block-sm pr-0 ms-nav-toggler" data-toggle="slideDown" data-target="#ms-nav-options">
     <span class="ms-toggler-bar bg-primary"></span>
     <span class="ms-toggler-bar bg-primary"></span>
     <span class="ms-toggler-bar bg-primary"></span>
   </div>

 </nav>