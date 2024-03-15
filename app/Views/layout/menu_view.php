<?php /*
<div class="ms-content-wrapper">
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb pl-0">
                    <li class="breadcrumb-item"><a href="<?= base_url('/') ?>"><i class="material-icons">home</i> Menu</a></li>
                </ol>
            </nav>
        </div>
        <div class="col-1"></div>
        <div class="col-xl-4 col-md-4">
            <a href="<?= base_url('ventas/listado') ?>">
                <div class="ms-panel ms-panel-hoverable has-border ms-widget ms-has-new-msg ms-notification-widget">
                    <span class="msg-count">6</span>
                    <div class="ms-panel-body media">
                        <i class="fas fa-dollar-sign" style="font-size: 58px;"></i>
                        <div class="media-body">
                            <h6>Mis Ventas</h6>
                            <span>Administrar Ventas</span>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-4 col-md-4">
            <a href="<?= base_url('deudas/listado') ?>">
                <div class="ms-panel ms-widget ms-panel-hoverable has-border ms-has-new-msg ms-notification-widget">
                    <span class="msg-count">5</span>
                    <div class="ms-panel-body media">
                        <i class="fas fa-credit-card" style="font-size: 58px;"></i>
                        <div class="media-body">
                            <h6>Deudas</h6>
                            <span>Administrar Deudas</span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-1"></div>
        <div class="col-xl-4 col-md-4" style="display: none;">
            <a href="<?= base_url('productos/listado') ?>">
                <div class="ms-panel ms-panel-hoverable has-border ms-widget ms-has-new-msg ms-notification-widget">
                    <span class="msg-count">6</span>
                    <div class="ms-panel-body media">
                        <i class="material-icons" style="font-size: 64px;">folder</i>
                        <div class="media-body">
                            <h6>Mis Productos</h6>
                            <span>Administrar Productos</span>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-4 col-md-4">
            <a href="<?= base_url('clientes/listado') ?>">
                <div class="ms-panel ms-widget ms-panel-hoverable has-border ms-has-new-msg ms-notification-widget">
                    <span class="msg-count">5</span>
                    <div class="ms-panel-body media">
                        <i class="material-icons" style="font-size: 64px;">people</i>
                        <div class="media-body">
                            <h6>Mis Clientes</h6>
                            <span>Administrar Clientes</span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xl-4 col-md-4">
            <a href="<?= base_url('rutas/nueva') ?>">
                <div class="ms-panel ms-widget ms-panel-hoverable has-border ms-has-new-msg ms-notification-widget">
                    <span class="msg-count">5</span>
                    <div class="ms-panel-body media">
                        <i class="material-icons" style="font-size: 64px;">people</i>
                        <div class="media-body">
                            <h6>Nueva Ruta</h6>
                            <span>Administrar Rutas</span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="row" style="display: none;">
        <div class="col-1"></div>

        <div class="col-xl-4 col-md-4" style="display: none;">
            <a href="<?= base_url('') ?>">
                <div class="ms-panel ms-widget ms-panel-hoverable has-border ms-has-new-msg ms-notification-widget">
                    <span class="msg-count">3</span>
                    <div class="ms-panel-body media">
                        <i class="material-icons" style="font-size: 64px;">help</i>
                        <div class="media-body">
                            <h6>Support Tickets</h6>
                            <span>View tickets</span>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-4 col-md-4">
            <a href="#">
                <div class="ms-panel ms-widget ms-panel-hoverable has-border ms-has-new-msg ms-notification-widget">
                    <span class="msg-count">2</span>
                    <div class="ms-panel-body media">
                        <i class="material-icons" style="font-size: 64px;">graphic_eq</i>
                        <div class="media-body">
                            <h6>Management</h6>
                            <span>Manage Product</span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="row" style="display: none;">

        <!-- Users by country table -->
        <div class="col-xl-6 col-md-12">
            <div class="ms-panel ms-widget ms-panel-fh">
                <div class="ms-panel-header">
                    <h6>Users By Country</h6>
                    <p>Your user base based on country</p>
                </div>
                <div class="ms-panel-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Country</th>
                                    <th scope="col">Users</th>
                                    <th scope="col">Percentage</th>
                                    <th scope="col">Exits</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row"> <img src="..\..\assets\img\flags\us.png" alt="flags"></th>
                                    <td>725</td>
                                    <td>17.24%</td>
                                    <td>234</td>
                                </tr>
                                <tr>
                                    <th scope="row"> <img src="..\..\assets\img\flags\grm.png" alt="flags"></th>
                                    <td>890</td>
                                    <td>12.90%</td>
                                    <td>425</td>
                                </tr>
                                <tr>
                                    <th scope="row"> <img src="..\..\assets\img\flags\uk.png" alt="flags"></th>
                                    <td>729</td>
                                    <td>20.75%</td>
                                    <td>598</td>
                                </tr>
                                <tr>
                                    <th scope="row"> <img src="..\..\assets\img\flags\russia.png" alt="flags"></th>
                                    <td>316</td>
                                    <td>32.09%</td>
                                    <td>112</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Users Pie Chart -->
        <div class="col-xl-6 col-md-12">
            <div class="ms-panel ms-panel-fh">
                <div class="ms-panel-header">
                    <h6>Users</h6>
                    <p>Users by country visualized</p>
                </div>
                <div class="ms-panel-body">
                    <div class="row">
                        <div class="col-xl-4 col-md-4">
                            <div class="ms-graph-labels column-direction">
                                <div class="ms-chart-no-label">
                                    <span class="bg-success"></span>
                                    <p>$9,348,319</p>
                                </div>
                                <div class="ms-chart-no-label">
                                    <span class="bg-primary"></span>
                                    <p>$4,344,316</p>
                                </div>
                                <div class="ms-chart-no-label">
                                    <span class="bg-warning"></span>
                                    <p>$518,513</p>
                                </div>
                                <div class="ms-chart-no-label">
                                    <span class="bg-danger"></span>
                                    <p>$348,319</p>
                                </div>
                                <div class="ms-chart-no-label">
                                    <span class="bg-secondary"></span>
                                    <p>$3,416,139</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-8 col-md-8">
                            <canvas id="pie-chart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- User Traffic Line Chart -->
        <div class="col-xl-7 col-md-12">
            <div class="ms-panel ms-panel-fh">
                <div class="ms-panel-header">
                    <h6>User Traffic</h6>
                    <p>Track User Traffic</p>
                </div>
                <div class="ms-panel-body">
                    <canvas id="line-chart"></canvas>
                </div>
            </div>
        </div>

        <div class="col-xl-5 col-md-12">
            <div class="ms-panel ms-panel-fh ms-facebook-engagements">
                <div class="ms-panel-header">
                    <h6>User Purchases</h6>
                    <p>Track which purchases by month</p>
                </div>
                <div class="ms-panel-body p-0">
                    <div class="ms-facebook-page-selection">
                        <p class="ms-text-dark">March 25, 2020 to April 02, 2020</p>
                        <span>Product: </span>
                        <div class="dropdown">
                            <a href="#" class="has-chevron" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Product Name here</a>
                            <ul class="dropdown-menu">
                                <li class="ms-dropdown-list">
                                    <a class="media p-2" href="#">
                                        <div class="media-body">
                                            <span>Product 1</span>
                                        </div>
                                    </a>
                                    <a class="media p-2" href="#">
                                        <div class="media-body">
                                            <span>Product 2</span>
                                        </div>
                                    </a>
                                    <a class="media p-2" href="#">
                                        <div class="media-body">
                                            <span>Product 3</span>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <ul class="ms-list clearfix">
                        <li class="ms-list-item">
                            <div class="d-flex justify-content-between align-items-end">
                                <div class="ms-graph-meta">
                                    <h2>January, 2020</h2>
                                    <p class="ms-text-dark">45.07%</p>
                                    <p class="ms-text-success">+28.44%</p>
                                    <p>VS 66.68% (Prev)</p>
                                </div>
                                <div class="ms-graph-canvas">
                                    <canvas id="engaged-users"></canvas>
                                </div>
                            </div>
                        </li>
                        <li class="ms-list-item">
                            <div class="d-flex justify-content-between align-items-end">
                                <div class="ms-graph-meta">
                                    <h2>February, 2020</h2>
                                    <p class="ms-text-dark">9.07%</p>
                                    <p class="ms-text-danger">-2.31%</p>
                                    <p>VS 45.07% (Prev)</p>
                                </div>
                                <div class="ms-graph-canvas">
                                    <canvas id="page-impressions"></canvas>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Chat -->
        <div class="col-xl-6 col-md-12">
            <div class="ms-panel ms-panel-fh ms-widget ms-chat-conversations">
                <div class="ms-panel-header">
                    <div class="ms-chat-header justify-content-between">
                        <div class="ms-chat-user-container media clearfix">
                            <div class="ms-chat-status ms-status-online ms-chat-img mr-3 align-self-center">
                                <img src="..\..\assets\img\people\people-7.jpg" class="ms-img-round" alt="people">
                            </div>
                            <div class="media-body ms-chat-user-info mt-1">
                                <h6>Heather Brown</h6>
                                <span class="text-disabled fs-12">
                                    Active Now
                                </span>
                            </div>
                        </div>
                        <ul class="ms-list ms-list-flex ms-chat-controls">
                            <li data-toggle="tooltip" data-placement="top" title="Call"> <i class="material-icons">local_phone</i> </li>
                            <li data-toggle="tooltip" data-placement="top" title="Video Call"> <i class="material-icons">videocam</i> </li>
                            <li data-toggle="tooltip" data-placement="top" title="Add to Chat"> <i class="material-icons">person_add</i> </li>
                        </ul>
                    </div>
                </div>
                <div class="ms-panel-body ms-scrollable">
                    <div class="ms-chat-bubble ms-chat-message ms-chat-outgoing media clearfix">
                        <div class="ms-chat-status ms-status-online ms-chat-img">
                            <img src="..\..\assets\img\people\people-7.jpg" class="ms-img-round" alt="people">
                        </div>
                        <div class="media-body">
                            <div class="ms-chat-text">
                                <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                            </div>
                            <p class="ms-chat-time">10:33 pm</p>
                        </div>
                    </div>
                    <div class="ms-chat-bubble ms-chat-message ms-chat-incoming media clearfix">
                        <div class="ms-chat-status ms-status-online ms-chat-img">
                            <img src="..\..\assets\img\people\people-3.jpg" class="ms-img-round" alt="people">
                        </div>
                        <div class="media-body">
                            <div class="ms-chat-text">
                                <p> I'm doing great, thanks for asking </p>
                                <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard </p>
                            </div>
                            <p class="ms-chat-time">11:01 pm</p>
                        </div>
                    </div>
                    <div class="ms-chat-bubble ms-chat-message ms-chat-outgoing media clearfix">
                        <div class="ms-chat-status ms-status-online ms-chat-img">
                            <img src="..\..\assets\img\people\people-7.jpg" class="ms-img-round" alt="people">
                        </div>
                        <div class="media-body">
                            <div class="ms-chat-text">
                                <p> It is a long established fact that a reader will be distracted by the readable content of a page </p>
                                <p> There are many variations of passages of Lorem Ipsum available </p>
                            </div>
                            <p class="ms-chat-time">11:03 pm</p>
                        </div>
                    </div>
                    <div class="ms-panel-footer">
                        <div class="ms-chat-textbox">
                            <ul class="ms-list-flex mb-0">
                                <li class="ms-chat-vn"><i class="material-icons">mic</i> </li>
                                <li class="ms-chat-input">
                                    <input type="text" name="msg" placeholder="Enter Message" value="">
                                </li>
                                <li class="ms-chat-text-controls ms-list-flex">
                                    <span> <i class="material-icons">tag_faces</i> </span>
                                    <span> <i class="material-icons">attach_file</i> </span>
                                    <span> <i class="material-icons">camera_alt</i> </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Support Tickets -->
        <div class="col-xl-6 col-md-12">
            <div class="ms-panel ms-panel-fh">
                <div class="ms-panel-header">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6>Recent Support Tickets</h6>
                            <p>Some of the recent support tickets</p>
                        </div>
                        <a href="#" class="btn btn-primary"> View All</a>
                    </div>
                </div>
                <div class="ms-panel-body p-0">
                    <ul class="ms-list ms-feed ms-twitter-feed ms-recent-support-tickets">
                        <li class="ms-list-item">
                            <a href="#" class="media clearfix">
                                <img src="..\..\assets\img\people\people-12.jpg" class="ms-img-round ms-img-small" alt="This is another feature">
                                <div class="media-body">
                                    <div class="d-flex justify-content-between">
                                        <h4 class="ms-feed-user mb-0">Lorem ipsum dolor</h4>
                                        <span class="badge badge-success"> Open </span>
                                    </div>
                                    <span class="my-2 d-block"> <i class="material-icons">date_range</i> February 24, 2020</span>
                                    <p class="d-block"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla luctus lectus a facilisis bibendum. Duis quis convallis sapien ... </p>
                                    <div class="d-flex justify-content-between align-items-end">
                                        <div class="ms-feed-controls">
                                            <span>
                                                <i class="material-icons">chat</i> 16
                                            </span>
                                            <span>
                                                <i class="material-icons">attachment</i> 3
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="ms-list-item">
                            <a href="#" class="media clearfix">
                                <img src="..\..\assets\img\people\people-10.jpg" class="ms-img-round ms-img-small" alt="This is another feature">
                                <div class="media-body">
                                    <div class="d-flex justify-content-between">
                                        <h4 class="ms-feed-user mb-0">Lorem ipsum dolor</h4>
                                        <span class="badge badge-success"> Open </span>
                                    </div>
                                    <span class="my-2 d-block"> <i class="material-icons">date_range</i> February 24, 2020</span>
                                    <p class="d-block"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla luctus lectus a facilisis bibendum. Duis quis convallis sapien ... </p>
                                    <div class="d-flex justify-content-between align-items-end">
                                        <div class="ms-feed-controls">
                                            <span>
                                                <i class="material-icons">chat</i> 11
                                            </span>
                                            <span>
                                                <i class="material-icons">attachment</i> 1
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="ms-list-item">
                            <a href="#" class="media clearfix">
                                <img src="..\..\assets\img\people\people-11.jpg" class="ms-img-round ms-img-small" alt="This is another feature">
                                <div class="media-body">
                                    <div class="d-flex justify-content-between">
                                        <h4 class="ms-feed-user mb-0">Lorem ipsum dolor</h4>
                                        <span class="badge badge-danger"> Closed </span>
                                    </div>
                                    <span class="my-2 d-block"> <i class="material-icons">date_range</i> February 24, 2020</span>
                                    <p class="d-block"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla luctus lectus a facilisis bibendum. Duis quis convallis sapien ... </p>
                                    <div class="d-flex justify-content-between align-items-end">
                                        <div class="ms-feed-controls">
                                            <span>
                                                <i class="material-icons">chat</i> 21
                                            </span>
                                            <span>
                                                <i class="material-icons">attachment</i> 5
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
</div>
*/
?>


<div class="container-fluid py-4">
      <div class="row">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                <i class="material-icons opacity-10">weekend</i>
              </div>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">Today's Money</p>
                <h4 class="mb-0">$53k</h4>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
              <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+55% </span>than last week</p>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                <i class="material-icons opacity-10">person</i>
              </div>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">Today's Users</p>
                <h4 class="mb-0">2,300</h4>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
              <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+3% </span>than last month</p>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                <i class="material-icons opacity-10">person</i>
              </div>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">New Clients</p>
                <h4 class="mb-0">3,462</h4>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
              <p class="mb-0"><span class="text-danger text-sm font-weight-bolder">-2%</span> than yesterday</p>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                <i class="material-icons opacity-10">weekend</i>
              </div>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">Sales</p>
                <h4 class="mb-0">$103,430</h4>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
              <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+5% </span>than yesterday</p>
            </div>
          </div>
        </div>
      </div>
      <div class="row mt-4">
        <div class="col-lg-4 col-md-6 mt-4 mb-4">
          <div class="card z-index-2 ">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
              <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                <div class="chart">
                  <canvas id="chart-bars" class="chart-canvas" height="170"></canvas>
                </div>
              </div>
            </div>
            <div class="card-body">
              <h6 class="mb-0 ">Website Views</h6>
              <p class="text-sm ">Last Campaign Performance</p>
              <hr class="dark horizontal">
              <div class="d-flex ">
                <i class="material-icons text-sm my-auto me-1">schedule</i>
                <p class="mb-0 text-sm"> campaign sent 2 days ago </p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 mt-4 mb-4">
          <div class="card z-index-2  ">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
              <div class="bg-gradient-success shadow-success border-radius-lg py-3 pe-1">
                <div class="chart">
                  <canvas id="chart-line" class="chart-canvas" height="170"></canvas>
                </div>
              </div>
            </div>
            <div class="card-body">
              <h6 class="mb-0 "> Daily Sales </h6>
              <p class="text-sm "> (<span class="font-weight-bolder">+15%</span>) increase in today sales. </p>
              <hr class="dark horizontal">
              <div class="d-flex ">
                <i class="material-icons text-sm my-auto me-1">schedule</i>
                <p class="mb-0 text-sm"> updated 4 min ago </p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 mt-4 mb-3">
          <div class="card z-index-2 ">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
              <div class="bg-gradient-dark shadow-dark border-radius-lg py-3 pe-1">
                <div class="chart">
                  <canvas id="chart-line-tasks" class="chart-canvas" height="170"></canvas>
                </div>
              </div>
            </div>
            <div class="card-body">
              <h6 class="mb-0 ">Completed Tasks</h6>
              <p class="text-sm ">Last Campaign Performance</p>
              <hr class="dark horizontal">
              <div class="d-flex ">
                <i class="material-icons text-sm my-auto me-1">schedule</i>
                <p class="mb-0 text-sm">just updated</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row mb-4">
        <div class="col-lg-8 col-md-6 mb-md-0 mb-4">
          <div class="card">
            <div class="card-header pb-0">
              <div class="row">
                <div class="col-lg-6 col-7">
                  <h6>Projects</h6>
                  <p class="text-sm mb-0">
                    <i class="fa fa-check text-info" aria-hidden="true"></i>
                    <span class="font-weight-bold ms-1">30 done</span> this month
                  </p>
                </div>
                <div class="col-lg-6 col-5 my-auto text-end">
                  <div class="dropdown float-lg-end pe-4">
                    <a class="cursor-pointer" id="dropdownTable" data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="fa fa-ellipsis-v text-secondary"></i>
                    </a>
                    <ul class="dropdown-menu px-2 py-3 ms-sm-n4 ms-n5" aria-labelledby="dropdownTable">
                      <li><a class="dropdown-item border-radius-md" href="javascript:;">Action</a></li>
                      <li><a class="dropdown-item border-radius-md" href="javascript:;">Another action</a></li>
                      <li><a class="dropdown-item border-radius-md" href="javascript:;">Something else here</a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Companies</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Members</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Budget</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Completion</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div>
                            <img src="../assets/img/small-logos/logo-xd.svg" class="avatar avatar-sm me-3" alt="xd">
                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">Material XD Version</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="avatar-group mt-2">
                          <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ryan Tompson">
                            <img src="../assets/img/team-1.jpg" alt="team1">
                          </a>
                          <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Romina Hadid">
                            <img src="../assets/img/team-2.jpg" alt="team2">
                          </a>
                          <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Alexander Smith">
                            <img src="../assets/img/team-3.jpg" alt="team3">
                          </a>
                          <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Jessica Doe">
                            <img src="../assets/img/team-4.jpg" alt="team4">
                          </a>
                        </div>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <span class="text-xs font-weight-bold"> $14,000 </span>
                      </td>
                      <td class="align-middle">
                        <div class="progress-wrapper w-75 mx-auto">
                          <div class="progress-info">
                            <div class="progress-percentage">
                              <span class="text-xs font-weight-bold">60%</span>
                            </div>
                          </div>
                          <div class="progress">
                            <div class="progress-bar bg-gradient-info w-60" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div>
                            <img src="../assets/img/small-logos/logo-atlassian.svg" class="avatar avatar-sm me-3" alt="atlassian">
                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">Add Progress Track</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="avatar-group mt-2">
                          <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Romina Hadid">
                            <img src="../assets/img/team-2.jpg" alt="team5">
                          </a>
                          <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Jessica Doe">
                            <img src="../assets/img/team-4.jpg" alt="team6">
                          </a>
                        </div>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <span class="text-xs font-weight-bold"> $3,000 </span>
                      </td>
                      <td class="align-middle">
                        <div class="progress-wrapper w-75 mx-auto">
                          <div class="progress-info">
                            <div class="progress-percentage">
                              <span class="text-xs font-weight-bold">10%</span>
                            </div>
                          </div>
                          <div class="progress">
                            <div class="progress-bar bg-gradient-info w-10" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div>
                            <img src="../assets/img/small-logos/logo-slack.svg" class="avatar avatar-sm me-3" alt="team7">
                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">Fix Platform Errors</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="avatar-group mt-2">
                          <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Romina Hadid">
                            <img src="../assets/img/team-3.jpg" alt="team8">
                          </a>
                          <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Jessica Doe">
                            <img src="../assets/img/team-1.jpg" alt="team9">
                          </a>
                        </div>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <span class="text-xs font-weight-bold"> Not set </span>
                      </td>
                      <td class="align-middle">
                        <div class="progress-wrapper w-75 mx-auto">
                          <div class="progress-info">
                            <div class="progress-percentage">
                              <span class="text-xs font-weight-bold">100%</span>
                            </div>
                          </div>
                          <div class="progress">
                            <div class="progress-bar bg-gradient-success w-100" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div>
                            <img src="../assets/img/small-logos/logo-spotify.svg" class="avatar avatar-sm me-3" alt="spotify">
                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">Launch our Mobile App</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="avatar-group mt-2">
                          <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ryan Tompson">
                            <img src="../assets/img/team-4.jpg" alt="user1">
                          </a>
                          <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Romina Hadid">
                            <img src="../assets/img/team-3.jpg" alt="user2">
                          </a>
                          <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Alexander Smith">
                            <img src="../assets/img/team-4.jpg" alt="user3">
                          </a>
                          <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Jessica Doe">
                            <img src="../assets/img/team-1.jpg" alt="user4">
                          </a>
                        </div>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <span class="text-xs font-weight-bold"> $20,500 </span>
                      </td>
                      <td class="align-middle">
                        <div class="progress-wrapper w-75 mx-auto">
                          <div class="progress-info">
                            <div class="progress-percentage">
                              <span class="text-xs font-weight-bold">100%</span>
                            </div>
                          </div>
                          <div class="progress">
                            <div class="progress-bar bg-gradient-success w-100" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div>
                            <img src="../assets/img/small-logos/logo-jira.svg" class="avatar avatar-sm me-3" alt="jira">
                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">Add the New Pricing Page</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="avatar-group mt-2">
                          <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ryan Tompson">
                            <img src="../assets/img/team-4.jpg" alt="user5">
                          </a>
                        </div>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <span class="text-xs font-weight-bold"> $500 </span>
                      </td>
                      <td class="align-middle">
                        <div class="progress-wrapper w-75 mx-auto">
                          <div class="progress-info">
                            <div class="progress-percentage">
                              <span class="text-xs font-weight-bold">25%</span>
                            </div>
                          </div>
                          <div class="progress">
                            <div class="progress-bar bg-gradient-info w-25" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="25"></div>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div>
                            <img src="../assets/img/small-logos/logo-invision.svg" class="avatar avatar-sm me-3" alt="invision">
                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">Redesign New Online Shop</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="avatar-group mt-2">
                          <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ryan Tompson">
                            <img src="../assets/img/team-1.jpg" alt="user6">
                          </a>
                          <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Jessica Doe">
                            <img src="../assets/img/team-4.jpg" alt="user7">
                          </a>
                        </div>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <span class="text-xs font-weight-bold"> $2,000 </span>
                      </td>
                      <td class="align-middle">
                        <div class="progress-wrapper w-75 mx-auto">
                          <div class="progress-info">
                            <div class="progress-percentage">
                              <span class="text-xs font-weight-bold">40%</span>
                            </div>
                          </div>
                          <div class="progress">
                            <div class="progress-bar bg-gradient-info w-40" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="40"></div>
                          </div>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6">
          <div class="card h-100">
            <div class="card-header pb-0">
              <h6>Orders overview</h6>
              <p class="text-sm">
                <i class="fa fa-arrow-up text-success" aria-hidden="true"></i>
                <span class="font-weight-bold">24%</span> this month
              </p>
            </div>
            <div class="card-body p-3">
              <div class="timeline timeline-one-side">
                <div class="timeline-block mb-3">
                  <span class="timeline-step">
                    <i class="material-icons text-success text-gradient">notifications</i>
                  </span>
                  <div class="timeline-content">
                    <h6 class="text-dark text-sm font-weight-bold mb-0">$2400, Design changes</h6>
                    <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">22 DEC 7:20 PM</p>
                  </div>
                </div>
                <div class="timeline-block mb-3">
                  <span class="timeline-step">
                    <i class="material-icons text-danger text-gradient">code</i>
                  </span>
                  <div class="timeline-content">
                    <h6 class="text-dark text-sm font-weight-bold mb-0">New order #1832412</h6>
                    <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">21 DEC 11 PM</p>
                  </div>
                </div>
                <div class="timeline-block mb-3">
                  <span class="timeline-step">
                    <i class="material-icons text-info text-gradient">shopping_cart</i>
                  </span>
                  <div class="timeline-content">
                    <h6 class="text-dark text-sm font-weight-bold mb-0">Server payments for April</h6>
                    <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">21 DEC 9:34 PM</p>
                  </div>
                </div>
                <div class="timeline-block mb-3">
                  <span class="timeline-step">
                    <i class="material-icons text-warning text-gradient">credit_card</i>
                  </span>
                  <div class="timeline-content">
                    <h6 class="text-dark text-sm font-weight-bold mb-0">New card added for order #4395133</h6>
                    <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">20 DEC 2:20 AM</p>
                  </div>
                </div>
                <div class="timeline-block mb-3">
                  <span class="timeline-step">
                    <i class="material-icons text-primary text-gradient">key</i>
                  </span>
                  <div class="timeline-content">
                    <h6 class="text-dark text-sm font-weight-bold mb-0">Unlock packages for development</h6>
                    <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">18 DEC 4:54 AM</p>
                  </div>
                </div>
                <div class="timeline-block">
                  <span class="timeline-step">
                    <i class="material-icons text-dark text-gradient">payments</i>
                  </span>
                  <div class="timeline-content">
                    <h6 class="text-dark text-sm font-weight-bold mb-0">New order #9583120</h6>
                    <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">17 DEC</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>