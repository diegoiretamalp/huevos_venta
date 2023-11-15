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