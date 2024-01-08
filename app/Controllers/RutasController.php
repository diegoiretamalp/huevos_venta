<?php

namespace App\Controllers;

class RutasController extends BaseController
{
    public function __construct()
    {
        $this->session = session();
        $this->Productos_model = model('App\Models\Productos_model');
        $this->Clientes_model = model('App\Models\Clientes_model');
        $this->Usuarios_model = model('App\Models\Usuarios_model');
        $this->Monedero_model = model('App\Models\Monedero_model');
        $this->Rutas_model = model('App\Models\Rutas_model');
        $this->Ventas_model = model('App\Models\Ventas_model');
    }
    public function index()
    {
        $rutas_where = [
            'estado' => true,
            'eliminado' => false,
        ];
        $rutas = $this->Rutas_model->getRutas($rutas_where);
        if (!empty($rutas)) {
            foreach ($rutas as $ruta) {
                $ventas = $this->Ventas_model->getVentasRuta($ruta->id);
                if (!empty($ventas)) {
                    $total_venta = 0;
                    $total_pagado = 0;
                    $total_efectivo = 0;
                    $total_fiado = 0;
                    $total_transferencia = 0;
                    // pre_die($ventas);
                    foreach ($ventas as $venta) {
                        $total_venta += $venta->total_venta;

                        $pagos_venta = GetObjectByWhere('pagos_venta', ['venta_id' => $venta->id]);
                        if (!empty($pagos_venta)) {
                            $total_pagado += SumaGeneralRow($pagos_venta, 'monto_pago_actual');
                            foreach ($pagos_venta as $pago) {
                                if ($pago->metodo_pago_id == 2) {
                                    $total_efectivo += $pago->monto_pago_actual;
                                } elseif ($pago->metodo_pago_id == 1) {
                                    $total_fiado += $pago->monto_total;
                                } elseif ($pago->metodo_pago_id == 3) {
                                    $total_transferencia += $pago->monto_pago_actual;
                                }
                            }
                        }
                    }
                    $ruta->total_venta = $total_venta;
                    $ruta->total_pagado = $total_pagado;
                    $ruta->total_efectivo = $total_efectivo;
                    $ruta->total_fiado = $total_fiado;
                    $ruta->total_transferencia = $total_transferencia;
                }

                $gastos = GetObjectByWhere('gastos', ['ruta_id' => $ruta->id, 'estado' => true]);
                $total_gastos = 0;
                if (!empty($gastos)) {
                    $total_gastos += SumaGeneralRow($gastos, 'monto');
                }
                $ruta->gastos_ruta = $total_gastos;
            }
        }
        $data = [
            'title' => 'Listado de Rutas',
            'main_view' => 'rutas/rutas_list_view',
            'rutas' => !empty($rutas) ? $rutas  : [],
            'js_content' => [
                '0' => 'layout/js/generalJS'
            ]
        ];
        return view('layout/layout_main_view', $data);
    }
    public function NuevaRuta()
    {
        $post = $this->request->getPost();
        if (!empty($post)) {

            $clientes_ruta = !empty($post['clientes_ruta']) ? json_decode($post['clientes_ruta']) : [];
            $new_ruta = [
                'repartidor_id' => !empty($post['repartidor_id']) ? $post['repartidor_id'] : NULL,
                'cajas_total' => !empty($post['total_cajas']) ? $post['total_cajas'] : NULL,
                'fecha_ruta' => !empty($post['fecha_ruta']) ? ordenar_fechaServidor($post['fecha_ruta']) : NULL,
                'comuna_id' => !empty($post['comuna_id']) ? $post['comuna_id'] : NULL,
                'estado' => 1,
                'created_at' => getTimestamp(),
            ];
            $ruta_id = $this->Rutas_model->insertRuta($new_ruta);
            if ($ruta_id > 0) {
                if (!empty($clientes_ruta)) {
                    $count = 0;
                    foreach ($clientes_ruta as $cliente) {
                        $new_cliente_ruta = [
                            'cliente_id' => $cliente->id,
                            'ruta_id' => $ruta_id,
                            'posicion' => $cliente->posicion,
                            'venta' => false,
                            'estado_cliente_ruta_id' => 2
                        ];
                        #ESTADOS CLIENTE RUTE
                        #1 FINALIZADO
                        #2 PENDIENTE
                        #3 SIN VENTA
                        $cliente_ruta_id = InsertRowTable('clientes_ruta', $new_cliente_ruta);
                        if ($cliente_ruta_id > 0) {
                            $count++;
                        }
                    }
                    if ($count > 0) {
                        $ruta_edit_id = $this->Rutas_model->updateRuta(['cantidad_clientes' => $count, 'updated_at' => getTimestamp()], $ruta_id);
                    }
                }
                $this->session->setflashdata("success_title", "Gestión de Rutas");
                $this->session->setflashdata("success", "Se ha realizado la creación de la Ruta correctamente.");
                return redirect('rutas/listado');
            } else {
                $this->session->setflashdata("error_title", "Error Interno");
                $this->session->setflashdata("error", "Ha Ocurrido un problema al crear la ruta. Intentelo Nuevamente, si el problema persiste contácte a Soporte");
                $this->session->setflashdata("errores", $post);
                return redirect('rutas/nueva');
            }
        }

        $where_productos = [
            'estado' => true,
            'eliminado' => false,
        ];
        $where_clientes = [
            'cli.estado' => true,
            'cli.eliminado' => false,
        ];
        $where_repartidores = [
            'estado' => true,
            'eliminado' => false,
            'perfil_id' => 4,
        ];

        $productos = $this->Productos_model->getProductos($where_productos);
        $clientes = $this->Clientes_model->getClientes($where_clientes);
        $repartidores = $this->Usuarios_model->getUsuarios($where_repartidores);
        $comunas = GetObjectByWhere('comunas', ['estado' => true]);
        $regiones = GetObjectByWhere('regiones', ['estado' => true]);
        $sectores = GetObjectByWhere('sectores', ['estado' => true, 'eliminado' => false]);

        $grupos = GetObjectByWhere('grupos', ['estado' => true, 'deleted' => false]);

        $data = [
            'title' => 'Nueva Ruta',
            'main_view' => 'rutas/rutas_new_view',
            'productos' => !empty($productos) ? $productos : [],
            'clientes' => !empty($clientes) ? $clientes : [],
            'repartidores' => !empty($repartidores) ? $repartidores : [],
            'comunas' => !empty($comunas) ? $comunas : [],
            'regiones' => !empty($regiones) ? $regiones : [],
            'sectores' => !empty($sectores) ? $sectores : [],
            'grupos' => !empty($grupos) ? $grupos : [],
            'js_content' => [
                '0' => 'layout/js/generalJS',
                '1' => 'rutas/js/RutasNewJS'
            ]
        ];
        return view('layout/layout_main_view', $data);
    }
    public function VerRuta($id)
    {
        $post = $this->request->getPost();
        $where_productos = [
            'estado' => true,
            'eliminado' => false,
        ];
        $productos = $this->Productos_model->getProductos($where_productos);

        if (!is_numeric($id)) {
            return redirect('rutas/listado');
        }
        $ruta = $this->Rutas_model->getRuta($id);
        if (empty($ruta)) {
            $this->session->setflashdata("error_title", "Error Interno");
            $this->session->setflashdata("error", "Ruta no existe o fue eliminada.");
            return redirect('rutas/listado');
        }
        $where_clientes_ruta = [
            'ruta_id' => $id,
        ];
        $clientes_ruta = GetObjectByWhere('clientes_ruta', $where_clientes_ruta);
        if (!empty($clientes_ruta)) {
            foreach ($clientes_ruta as $cliente_r) {
                $cliente = $this->Clientes_model->getCliente($cliente_r->cliente_id);
                //pre_die($cliente);
                if (!empty($cliente)) {
                    $total_deuda = $this->Ventas_model->GetTotalDeudaCliente($cliente->id);
                    $total_venta = $this->Ventas_model->GetTotalVentaCliente($cliente->id);

                    $td = !empty($total_deuda) ? $total_deuda : 0;
                    $tv = !empty($total_venta) ? $total_venta->total_venta : 0;

                    $cliente_r->total_pagado = formatear_numero($tv - $td);
                    $cliente_r->total_venta = !empty($total_venta->total_venta) ? ($total_venta->total_venta) : 0;
                    $cliente_r->cajas_total = !empty($total_venta->cajas_total) ? $total_venta->cajas_total : 0;
                    $cliente_r->total_venta = !empty($tv) ? formatear_numero($tv) : '$0';

                    $cliente_r->direccion = !empty($cliente->direccion) ? $cliente->direccion : '';
                    $cliente_r->nombre_completo = (!empty($cliente->nombre) ? $cliente->nombre : '') . ' ' . (!empty($cliente->apellido_paterno) ? $cliente->apellido_paterno : '') . ' ' . (!empty($cliente->apellido_matero) ? $cliente->apellido_matero : '');
                    $cliente_r->total_deuda = !empty($total_deuda) ? formatear_numero($total_deuda) : '$0';
                    $cliente_r->precio_favorito = formatear_numero($cliente->precio_favorito);
                    $cliente_r->producto_id = $cliente->producto_id;
                }
            }
        }

        $ventas = $this->Ventas_model->getVentasRuta($ruta->id);
        if (!empty($ventas)) {
            $total_venta = 0;
            $total_pagado = 0;
            $total_efectivo = 0;
            $total_deposito = 0;
            $total_fiado = 0;
            $total_fiado_pagado = 0;
            $total_transferencia = 0;
            $pagos_venta = [];
            foreach ($ventas as $venta) {

                $total_venta += $venta->total_venta;

                $pagos_venta = GetObjectByWhere('pagos_venta', ['venta_id' => $venta->id]);
                // pre_die($pagos_venta);
                if (!empty($pagos_venta)) {
                    $total_pagado += SumaGeneralRow($pagos_venta, 'monto_pago_actual');
                    foreach ($pagos_venta as $pago) {
                        if ($pago->metodo_pago_id == 2) {
                            $total_efectivo += $pago->monto_pago_actual;
                        } elseif ($pago->metodo_pago_id == 1) {
                            $total_fiado += $pago->monto_total;
                        } elseif ($pago->metodo_pago_id == 3) {
                            $total_transferencia += $pago->monto_pago_actual;
                        } elseif ($pago->metodo_pago_id == 4) {
                            $total_deposito += $pago->monto_pago_actual;
                        }
                    }
                    //pre_die($pagos_venta);
                }
            }

            $fiados_pagados = GetPagosVentaYFiados($ruta->id);
            // pre_die($fiados_pagados);
            $ruta->total_pagado = $total_pagado;
            $ruta->total_efectivo = $total_efectivo;
            $ruta->total_fiado = $total_fiado;
            $ruta->total_venta = $total_venta - $total_fiado;
            $ruta->total_transferencia = $total_transferencia;
            $ruta->total_deposito = $total_deposito;
            $ruta->total_fiado_pagado = $fiados_pagados->fiado_pagado_ruta;
        }

        $gastos = GetObjectByWhere('gastos', ['ruta_id' => $ruta->id, 'estado' => true]);
        $total_gastos = 0;
        if (!empty($gastos)) {
            $total_gastos += SumaGeneralRow($gastos, 'monto');
        }
        $ruta->gastos_ruta = $total_gastos;

        $where_clideu = [
            'v.pagado' => false,
            'v.estado' => true,
            'v.eliminado' => false,
        ];

        $clientes_deuda = $this->Clientes_model->getClientesDeuda($where_clideu);
        // pre_die($clientes_deuda);
        $data = [
            'title' => 'Ver Ruta',
            'main_view' => 'rutas/rutas_ver_view',
            'productos' => !empty($productos) ? $productos : [],
            'gastos' => !empty($gastos) ? $gastos : [],
            'ruta' => !empty($ruta) ? $ruta : [],
            'clientes_ruta' => !empty($clientes_ruta) ? $clientes_ruta : [],
            'clientes_deuda' => !empty($clientes_deuda) ? $clientes_deuda : [],
            'ruta_id' => !empty($id) ? $id : '',
            'js_content' => [
                '0' => 'layout/js/generalJS',
                '1' => 'rutas/js/RutasVerJS',
                '2' => 'rutas/js/FunctionRutaJS',
            ]
        ];
        return view('layout/layout_main_view', $data);
    }
    public function EditarRuta($id)
    {
        $post = $this->request->getPost();
        $data = [
            'main_view' => 'rutas/rutas_new_view'
        ];
        return view('layout/layout_main_view', $data);
    }
    public function EliminarRuta()
    {
        $post = $this->request->getPost();
        $data = [
            'main_view' => 'rutas/rutas_new_view'
        ];
        return view('layout/layout_main_view', $data);
    }

    public function ObtenerCliente()
    {
        $post = $this->request->getPost();
        if (!empty($post)) {
            $cliente = $this->Clientes_model->getCliente($post['cliente_id']);
            if (!empty($cliente)) {
                $cliente->rut_factura = formateaRut($cliente->rut_factura);
                $rsp = [
                    'tipo' => 'success',
                    'msg' => 'Datos cargados con éxito.',
                    'data' => !empty($cliente) ? $cliente : []
                ];
            } else {
                $rsp = [
                    'tipo' => 'error',
                    'msg' => 'Cliente no existe o fue eliminado.'
                ];
            }
        } else {
            $rsp = [
                'tipo' => 'error',
                'msg' => 'Datos no Recibidos por el Servidor'
            ];
        }
        return json_encode($rsp);
    }
    private function ValidaFields($data)
    {
        $error = [];
        $error_flag = false;

        if ($data['cliente_id'] < 0) {
            $error_flag = true;
            $error['cliente_id'] = 'Seleccionar Cliente';
        }
        if ($data['cliente_id'] == 0) {
            if (validateText(trim($data['nombre']))) {
                $error_flag = true;
                $error['nombre'] = 'Nombre';
            }
            if (validateText(trim($data['apellido_paterno']))) {
                $error_flag = true;
                $error['apellido_paterno'] = 'Apellido Paterno';
            }
            if (validateText(trim($data['apellido_materno']))) {
                $error_flag = true;
                $error['apellido_materno'] = 'Apellido Materno';
            }

            if (!validateRut(trim($data['rut_factura']))) {
                $error_flag = true;
                $error['rut_factura'] = 'Rut Inválido';
            }

            if (!empty($data['celular'])) {
                if (!is_numeric(trim($data['celular']))) {
                    $error_flag = true;
                    $error['celular'] = 'Celular';
                } else {
                    if (strlen($data['celular']) != 11) {
                        $error_flag = true;
                        $error['celular'] = 'Celular';
                    }
                }
            }

            if (validateEmail(trim($data['email']))) {
                $error_flag = true;
                $error['email'] = 'Correo electrónico';
            }

            if (!empty($data['direccion'])) {
                if (validateText(trim($data['direccion']))) {
                    $error_flag = true;
                    $error['nombre'] = 'Nombre';
                }
            }
        }

        if (empty($data['data_carrito'])) {
            $error_flag = true;
            $error['data_carrito'] = 'No se han seleccionado productos para la venta';
        }
        $data_carrito = json_decode($data['data_carrito']);
        if (count($data_carrito) <= 0) {
            $error_flag = true;
            $error['data_carrito'] = 'No se han seleccionado productos para la venta';
        }
        if (empty($data['metodo_pago'])) {
            $error_flag = true;
            $error['metodo_pago'] = 'No se ha seleccionado un metodo de pago';
        }
        if (!is_numeric($data['costo_total'])) {
            $error_flag = true;
            $error['costo_total'] = 'No se ha obtenido el Total de la Venta';
        }

        if (!isset($data['check_pago_total'])) {
            if (empty(trim($data['monto_pagado']))) {
                $error_flag = true;
                $error['monto_pagado'] = 'No se ha indicado el monto pagado';
            }
            if (!is_numeric($data['monto_pagado'])) {
                $error_flag = true;
                $error['monto_pagado'] = 'No se ha indicado el monto pagado';
            }

            if ($data['monto_pagado'] > $data['costo_total']) {
                $error_flag = true;
                $error['monto_pagado'] = 'El monto pagado no puede ser mayor al costo total de la venta.';
            }
        }


        if ($error_flag) {
            return $error;
        } else {
            return false;
        }
    }

    public function ObtenerClientesRuta()
    {
        $comuna_id = $this->request->getPost('comuna_id');
        $cliente_id = $this->request->getPost('cliente_id');
        // $sector_id = $this->request->getPost('sector_id');
        if (is_numeric($comuna_id)) {
            $where = [
                'c.estado' => true,
                'c.eliminado' => false,
                // 'c.region_id' => !empty($region_id) ? $region_id : '',
                'c.comuna_id' => !empty($comuna_id) ? $comuna_id : '',
            ];
            if (!empty($cliente_id)) {
                $where['c.id'] = $cliente_id;
            }
            $clientes = $this->Rutas_model->GetClientesRutaComuna($where);
            if (!empty($clientes)) {
                foreach ($clientes as $c) {
                    $total_deuda = $this->Ventas_model->GetTotalDeudaCliente($c->id);
                    $total_venta = $this->Ventas_model->GetTotalVentaCliente($c->id);
                    // $total_venta = $this->Ventas_model->GetTotalCajasVendidas($c->id);
                    $c->total_deuda = !empty($total_deuda) ? ($total_deuda) : 0;
                    $c->total_venta = !empty($total_venta->total_venta) ? ($total_venta->total_venta) : 0;
                    $c->cajas_total = !empty($total_venta->cajas_total) ? ($total_venta->cajas_total) : 0;
                    $c->total_pagado = formatear_numero($c->total_venta - $c->total_deuda);
                    $c->total_deuda = formatear_numero($c->total_deuda);
                    $c->total_venta = formatear_numero($c->total_venta);
                    $c->precio_favorito = formatear_numero($c->precio_favorito);
                }

                if (!empty($clientes)) {
                    $rsp = [
                        'tipo' => 'success',
                        'msg' => 'Clientes cargados con éxito.',
                        'data' => $clientes
                    ];
                } else {
                    $rsp = [
                        'tipo' => 'warning',
                        'msg' => 'No se han encontrado clientes para la comuna seleccionada'
                    ];
                }
            } else {
                $rsp = [
                    'tipo' => 'warning',
                    'msg' => 'No se han encontrado clientes para la comuna seleccionada'
                ];
            }
        } else {
            $rsp = [
                'tipo' => 'error',
                'msg' => 'Solo se permite la comuna de forma numerica'
            ];
        }

        return json_encode($rsp);
    }

    public function ObtenerClienteRuta($cliente_id)
    {
        $rsp = [];
        if (is_numeric($cliente_id)) {
            $cliente = $this->Clientes_model->getCliente($cliente_id);
            if (!empty($cliente)) {
                $where_venta = [
                    'estado' => true,
                    'eliminado' => false,
                    'cliente_id' => $cliente->id,
                ];
                $ultima_compra = $this->Ventas_model->GetVentaWhere($where_venta);
                $cliente->fecha_ultima_compra = '';
                if (!empty($ultima_compra)) {
                    $cliente->fecha_ultima_compra = $ultima_compra->created_at;
                }
                $where_monedero = [
                    'estado' => true,
                    'eliminado' => false,
                    'cliente_id' => $cliente->id
                ];
                $monedero = $this->Monedero_model->GetMonederoWhere($where_monedero);

                if (!empty($monedero)) {
                    $cliente->total_deuda = !empty($monedero->total_deuda) ? $monedero->total_deuda : 0;
                }
                $rsp = [
                    'tipo' => 'success',
                    'msg' => 'Cliente cargado con éxito',
                    'data' => $cliente
                ];
            } else {
                $rsp = [
                    'tipo' => 'error',
                    'msg' => 'Cliente no existe o fue eliminado'
                ];
            }
        } else {
            $rsp = [
                'tipo' => 'error',
                'msg' => 'Id de Cliente no recibido'
            ];
        }

        return json_encode($rsp);
    }

    public function CargarClienteVenta($cliente_id)
    {
        $rsp = [];

        if (is_numeric($cliente_id)) {
            $cliente = $this->Clientes_model->getCliente($cliente_id);

            if (!empty($cliente)) {
                $rsp = [
                    'tipo' => 'success',
                    'title' => 'Gestión de Usuarios',
                    'msg' => 'Datos cargados con éxito',
                    'data' => $cliente
                ];
                http_response_code(200); // Código de estado HTTP: 200 OK
            } else {
                $rsp = [
                    'tipo' => 'error',
                    'msg' => 'Cliente no existe o fue eliminado'
                ];
                http_response_code(404); // Código de estado HTTP: 404 Not Found
            }
        } else {
            $rsp = [
                'tipo' => 'error',
                'msg' => 'Datos no recibidos por el servidor'
            ];
            http_response_code(400); // Código de estado HTTP: 400 Bad Request
        }

        header('Content-Type: application/json');
        echo json_encode($rsp);
        exit;
    }

    public function CargarDeudasCliente($cliente_id)
    {
        $rsp = [];

        if (is_numeric($cliente_id)) {
            $where = [
                'v.cliente_id' => $cliente_id,
                'v.estado' => true,
                'v.pagado' => false,
                'v.eliminado' => false
            ];
            $deudas = $this->Clientes_model->getDeudasCliente($where);
            if (!empty($deudas)) {
                $rsp = [
                    'tipo' => 'success',
                    'title' => 'Gestión de Deudas',
                    'msg' => 'Datos cargados con éxito',
                    'data' => $deudas
                ];
                http_response_code(200); // Código de estado HTTP: 200 OK
            } else {
                $rsp = [
                    'tipo' => 'error',
                    'title' => 'Gestión de Deudas',
                    'msg' => 'Deudas no existe o fue eliminado',
                    'data' => []
                ];
                http_response_code(404); // Código de estado HTTP: 404 Not Found
            }
        } else {
            $rsp = [
                'tipo' => 'error',
                'title' => 'Gestión de Deudas',
                'msg' => 'Datos no recibidos por el servidor',
                'data' => []
            ];
            http_response_code(400); // Código de estado HTTP: 400 Bad Request
        }

        header('Content-Type: application/json');
        echo json_encode($rsp);
        exit;
    }


    public function CargarPrimeraVenta()
    {
        $post = $this->request->getPost();
        if (!empty($post)) {
            $where_venta = [
                'v.cliente_id' => $post['cliente_id'],
                'v.ruta_id' => $post['ruta_id'],
                'v.estado' => true
            ];
            $ventas = $this->Ventas_model->GetVentasDetalle($where_venta);
            // pre_die($ventas);
            if (!empty($ventas)) {

                foreach ($ventas as $key) {
                    $productos_venta = GetObjectByWhere('productos_venta', ['venta_id' => $key->id, 'ruta_id' => $key->ruta_id]);
                    if (!empty($productos_venta)) {
                        $nombres_producto = '';
                        foreach ($productos_venta as $p) {
                            $producto = $this->Productos_model->getProducto($p->producto_id);
                            $nombres_producto .= !empty($producto) ? ($producto->nombre . ', ') : [];
                        }
                        $key->nombres_productos = $nombres_producto;
                    }
                    $key->productos_venta_data = !empty($productos_venta) ? $productos_venta : [];
                }
                $rsp = [
                    'tipo' => 'success',
                    'msg' => 'Ventas cargadas con éxito',
                    'data' => $ventas
                ];
            } else {
                $rsp = [
                    'tipo' => 'warning',
                    'msg' => 'No se han registrado ventas para el cliente en la actual ruta'
                ];
            }
        } else {
            $rsp = [
                'tipo' => 'warning',
                'msg' => 'No se han recibido datos.'
            ];
        }
        return json_encode($rsp);
    }

    public function CargarDeudaCliente($cliente_id)
    {
        if (is_numeric($cliente_id)) {
            // $monedero = $this->Monedero_model->getMonederoWhere(['cliente_id' => $cliente_id, 'estado' => true, 'eliminado' => false]);
            $where_ventas = [
                'pagado' => false,
                'estado' => true,
                'eliminado' => false,
                'cliente_id' => $cliente_id,
            ];
            $ventas_deudas = $this->Ventas_model->getVentas($where_ventas);
            // pre_die(json_encode($ventas_deudas));
            $rsp = [
                'tipo' => 'success',
                'msg' => 'Deudas cargadas con éxito',
                'data' => $ventas_deudas,
            ];
        } else {
            $rsp = [
                'tipo' => 'error',
                'msg' => 'El cliente no existe o fue eliminado'
            ];
        }
        return json_encode($rsp);
    }

    public function CerrarRuta($ruta_id)
    {
        if (!is_numeric($ruta_id)) {
            return redirect('rutas/listado');
        }

        $ruta = $this->Rutas_model->getRuta($ruta_id);

        if (empty($ruta)) {
            return redirect('rutas/listado');
        }

        $post = $this->request->getPost();
        $data = [
            'title' => 'Cerrar Ruta',
            'main_view' => 'rutas/rutas_cerrar_view',
            'ruta' => !empty($ruta) ? $ruta : [],
            'ruta_id' => !empty($ruta_id) ? $ruta_id : '',
        ];
        return view('layout/layout_main_view', $data);
    }

    public function PagarDeudaCliente($deuda_id)
    {
        $rsp = [];
        $post = $this->request->getPost();
        if (is_numeric($deuda_id) && !empty($post['monto_deuda']) && !empty($post['metodo_pago'])) {
            // pre_die($post);
            $data_update = [
                'updated_at' => getTimestamp()
            ];
            $deuda = $this->Ventas_model->getVenta($deuda_id);
            if (!empty($deuda)) {
                $total_deuda = $deuda->total_venta - $deuda->total_pagado;
                if ($post['monto_deuda'] == $total_deuda || $post['monto_deuda'] < $total_deuda) {
                    $data_update['pagado'] = $post['monto_deuda'] == $total_deuda ? true : false;
                    $data_update['total_pagado'] = $post['monto_deuda'] + $deuda->total_pagado;
                    // pre_die($data_update);
                    $new_pago_venta = [
                        'venta_id' => $deuda_id,
                        'metodo_pago_id' => $post['metodo_pago'],
                        'monto_total' => $deuda->total_venta,
                        'monto_pago_actual' => $post['monto_deuda'],
                        'monto_pagado' => $data_update['total_pagado'],
                        'fiado_pagado' => true,
                        'ruta_id_fiado_pagado' => $post['ruta_id'],
                        'created_at' => getTimestamp()
                    ];

                    $rsp_pv = InsertRowTable('pagos_venta', $new_pago_venta);

                    if ($rsp_pv > 0) {
                        $rsp = $this->Ventas_model->updateVenta($data_update, $deuda_id);

                        if ($rsp > 0) {
                            $rsp = [
                                'tipo' => 'success',
                                'title' => 'Gestión de Deudas',
                                'msg' => 'Datos cargados con éxito',
                                'data' => []
                            ];
                            http_response_code(200); // Código de estado HTTP: 200 OK
                        } else {
                            $rsp = [
                                'tipo' => 'error',
                                'msg' => 'Deudas no existe o fue eliminado',
                                'title' => 'Gestión de Deudas',
                                'data' => []
                            ];
                            http_response_code(404); // Código de estado HTTP: 404 Not Found
                        }
                    } else {
                        $rsp = [
                            'tipo' => 'error',
                            'title' => 'Gestión de Deudas',
                            'msg' => 'No se ha realizado el pago de deuda, intente mas tarde.',
                            'data' => []
                        ];
                        http_response_code(400); // Código de estado HTTP: 400 Bad Request
                    }
                } else {
                    $rsp = [
                        'tipo' => 'error',
                        'title' => 'Gestión de Deudas',
                        'msg' => 'Monto a Pagar no puede ser mayor a deuda de venta',
                        'data' => []
                    ];
                    http_response_code(400); // Código de estado HTTP: 400 Bad Request
                }
            } else {
                $rsp = [
                    'tipo' => 'error',
                    'title' => 'Gestión de Deudas',
                    'msg' => 'No se ha encontrado la deuda.',
                    'data' => []
                ];
                http_response_code(400); // Código de estado HTTP: 400 Bad Request
            }
        } else {
            $rsp = [
                'tipo' => 'error',
                'msg' => 'Datos no recibidos por el servidor'
            ];
            http_response_code(400); // Código de estado HTTP: 400 Bad Request
        }

        header('Content-Type: application/json');
        echo json_encode($rsp);
        exit;
    }

    public function ObtenerClientesGrupo()
    {
        $grupo_id = $this->request->getPost('grupo_id');
        if (is_numeric($grupo_id)) {
            $where = [
                'id' => $grupo_id,
                'estado' => true,
                'deleted' => false,
            ];
            if (!empty($cliente_id)) {
                $where['c.id'] = $cliente_id;
            }
            $grupo = GetRowObjectByWhere('grupos', $where);

            if (!empty($grupo)) {
                $clientes_grupo = GetObjectByWhere('grupo_clientes', ['estado' => true, 'deleted' => false, 'grupo_id' => $grupo_id]);
                $clientes_return = [];
                foreach ($clientes_grupo as $c) {
                    $cliente = GetRowObjectByWhere('clientes', ['id' => $c->cliente_id]);
                    if (!empty($cliente)) {
                        $total_deuda = $this->Ventas_model->GetTotalDeudaCliente($cliente->id);
                        $total_venta = $this->Ventas_model->GetTotalVentaCliente($cliente->id);
                        // $total_venta = $this->Ventas_model->GetTotalCajasVendidas($c->id);
                        $cliente->total_deuda = !empty($total_deuda) ? ($total_deuda) : 0;
                        $cliente->total_venta = !empty($total_venta->total_venta) ? ($total_venta->total_venta) : 0;
                        $cliente->cajas_total = !empty($total_venta->cajas_total) ? ($total_venta->cajas_total) : 0;
                        $cliente->total_pagado = formatear_numero($cliente->total_venta - $cliente->total_deuda);
                        $cliente->total_deuda = formatear_numero($cliente->total_deuda);
                        $cliente->total_venta = formatear_numero($cliente->total_venta);
                        $cliente->precio_favorito = !empty($cliente->precio_favorito) ? formatear_numero($cliente->precio_favorito) : 0;
                        $cliente->nombre_producto_favorito = !empty($cliente->producto_id) ? (GetRowObjectByWhere('productos', ['id' =>$cliente->producto_id]))->nombre: 'Sin Información';
                    }
                    $clientes_return[] = $cliente;
                }


                if (!empty($grupo)) {
                    $rsp = [
                        'tipo' => 'success',
                        'msg' => 'Clientes cargados con éxito.',
                        'data' => $clientes_return
                    ];
                } else {
                    $rsp = [
                        'tipo' => 'warning',
                        'msg' => 'No se han encontrado clientes para la comuna seleccionada'
                    ];
                }
            } else {
                $rsp = [
                    'tipo' => 'warning',
                    'msg' => 'No se han encontrado clientes para la comuna seleccionada'
                ];
            }
        } else {
            $rsp = [
                'tipo' => 'error',
                'msg' => 'Solo se permite la comuna de forma numerica'
            ];
        }

        return json_encode($rsp);
    }
}
