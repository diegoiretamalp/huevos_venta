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
            'r.estado' => true,
            'r.eliminado' => false,
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
                    foreach ($ventas as $venta) {
                        $total_venta += $venta->total_venta;

                        $pagos_venta = GetObjectByWhere('pagos_venta', ['venta_id' => $venta->id]);
                        if (!empty($pagos_venta)) {
                            $total_pagado += SumaGeneralRow($pagos_venta, 'monto_pago_actual');
                            foreach ($pagos_venta as $pago) {
                                if ($pago->metodo_pago_id == 2) {
                                    $total_efectivo += $pago->monto_pago_actual;
                                } elseif ($pago->metodo_pago_id == 1) {
                                    $total_fiado += $pago->monto_pago_actual;
                                }
                            }
                        }
                    }
                    $ruta->total_venta = $total_venta;
                    $ruta->total_pagado = $total_pagado;
                    $ruta->total_efectivo = $total_efectivo;
                    $ruta->total_fiado = $total_fiado;
                }

                $gastos = GetObjectByWhere('gastos', ['ruta_id' => $ruta->id, 'estado' => true]);
                $total_gastos = 0;
                if (!empty($gastos)) {
                    pre_die($gastos);
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
                'estado_ruta_id' => 1,
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
        $data = [
            'title' => 'Nueva Ruta',
            'main_view' => 'rutas/rutas_new_view',
            'productos' => !empty($productos) ? $productos : [],
            'clientes' => !empty($clientes) ? $clientes : [],
            'repartidores' => !empty($repartidores) ? $repartidores : [],
            'comunas' => !empty($comunas) ? $comunas : [],
            'js_content' => [
                '0' => 'layout/js/generalJS',
                '1' => 'rutas/js/RutasJS'
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

        $where_clientes_ruta = [
            'ruta_id' => $id,
        ];
        $clientes_ruta = GetObjectByWhere('clientes_ruta', $where_clientes_ruta);
        if (!empty($clientes_ruta)) {
            foreach ($clientes_ruta as $cliente_r) {
                $cliente = $this->Clientes_model->getCliente($cliente_r->cliente_id);
                //pre_die($cliente);
                if (!empty($cliente)) {
                    $cliente_r->direccion = !empty($cliente->direccion) ? $cliente->direccion : '';
                    //pre_die($cliente);
                    $cliente_r->nombre_completo = (!empty($cliente->nombre) ? $cliente->nombre : '') . ' ' . (!empty($cliente->apellido_paterno) ? $cliente->apellido_paterno : '') . ' ' . (!empty($cliente->apellido_matero) ? $cliente->apellido_matero : '');
                    $where_venta = [
                        'estado' => true,
                        'eliminado' => false,
                        'cliente_id' => $cliente->id,
                    ];
                    $ultima_compra = $this->Ventas_model->GetVentaWhere($where_venta);
                    $cliente_r->fecha_ultima_compra = '';
                    if (!empty($ultima_compra)) {
                        $cliente_r->fecha_ultima_compra = $ultima_compra->created_at;
                    }
                    $where_monedero = [
                        'estado' => true,
                        'eliminado' => false,
                        'cliente_id' => $cliente->id
                    ];
                    $monedero = $this->Monedero_model->GetMonederoWhere($where_monedero);

                    if (!empty($monedero)) {
                        $cliente_r->total_deuda = !empty($monedero->total_deuda) ? $monedero->total_deuda : 0;
                    }

                    $cliente_r->monedero = $monedero;
                    $cliente_r->cliente_data = $cliente;
                }
            }
        }
        //pre_die($clientes_ruta);
        $data = [
            'title' => 'Ver Ruta',
            'main_view' => 'rutas/rutas_ver_view',
            'productos' => !empty($productos) ? $productos : [],
            'clientes_ruta' => !empty($clientes_ruta) ? $clientes_ruta : [],
            'ruta_id' => !empty($id) ? $id : '',
            'js_content' => [
                '0' => 'layout/js/generalJS',
                '1' => 'rutas/js/RutasVerJS'
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
        if (is_numeric($comuna_id)) {

            $clientes = $this->Rutas_model->GetClientesRutaComuna($comuna_id);

            if (!empty($clientes)) {
                foreach ($clientes as $cliente) {
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
                    'msg' => 'Datos cargados con éxito',
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
                'msg' => 'Datos no recibidos por le servidor'
            ];
        }

        return json_encode($rsp);
    }


    private function CrearMonedero($id_cliente)
    {
        $monedero = [
            'cliente_id' => $id_cliente,
            'saldo' => 0,
            'total_deuda' => 0,
            'total_pagado' => 0,
            'total_transferencia' => 0,
            'total_deposito' => 0,
            'total_efectivo' => 0,
            'total_fiado' => 0,
            'estado' => true,
            'eliminado' => false,
            'created_at' => getTimestamp()
        ];
        $id_monedero = $this->Monedero_model->insertMonedero($monedero);
        return $id_monedero > 0 ? $id_monedero : false;
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
            $ventas = $this->Ventas_model->getVentasJoin($where_venta);
            if (!empty($ventas)) {
                foreach ($ventas as $key) {
                    $productos_venta = GetObjectByWhere('productos_venta', ['venta_id' => $key->venta_id, 'ruta_id' => $key->ruta_id]);
                    if (!empty($productos_venta)) {
                        foreach ($productos_venta as $p) {
                            $producto = $this->Productos_model->getProducto($p->producto_id);
                            $p->producto_data = !empty($producto) ? $producto : [];
                        }
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
            $monedero = $this->Monedero_model->getMonederoWhere(['cliente_id' => $cliente_id, 'estado' => true, 'eliminado' => false]);
            $where_ventas = [
                'v.pagado' => false,
                'v.estado' => true,
                'v.eliminado' => false,
                'v.cliente_id' => $cliente_id,
            ];
            $ventas_deudas = $this->Ventas_model->getVentas($where_ventas);
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
}
