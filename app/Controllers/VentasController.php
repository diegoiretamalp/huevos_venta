<?php

namespace App\Controllers;

class VentasController extends BaseController
{
    public function __construct()
    {
        $this->session = session();
        $this->Productos_model = model('App\Models\Productos_model');
        $this->Clientes_model = model('App\Models\Clientes_model');
        $this->Monedero_model = model('App\Models\Monedero_model');
        $this->Rutas_model = model('App\Models\Rutas_model');
    }
    public function index()
    {
        $data = [
            'main_view' => 'ventas/ventas_list_view',
            'js_content' => [
                '0' => 'layout/js/generalJS'
            ]
        ];
        return view('layout/layout_main_view', $data);
    }
    public function NuevaVenta()
    {
        $post = $this->request->getPost();

        if (!empty($post)) {
            //pre_die($post);
            if ($validate = $this->ValidaFields($post)) {
                $this->session->setflashdata("error_title", "Error de Validación");
                $this->session->setflashdata("error", "Se encontraron los siguientes errores: " . implode(", ", $validate));
                $this->session->setflashdata("errores", $post);
                return redirect('ventas/nueva');
            } else {
                $cliente = NULL;
                if ($post['cliente_id'] > 0) {
                    $cliente = $this->Clientes_model->getCliente($post['cliente_id']);
                } else {
                    $cliente_array = [
                        'nombre' => !empty($post['nombre']) ? $post['nombre'] : NULL,
                        'apellido_paterno' => !empty($post['apellido_paterno']) ? $post['apellido_paterno'] : NULL,
                        'apellido_materno' => !empty($post['apellido_materno']) ? $post['apellido_materno'] : NULL,
                        'rut_factura' => !empty(!empty($post['rut_factura'])) ? $post['rut_factura'] : NULL,
                        'celular' => !empty($post['celular']) ? $post['celular'] : NULL,
                        'email' => !empty($post['email']) ? strLower($post['email']) : NULL,
                        'estado' => true,
                        'direccion' => !empty($post['direccion']) ? $post['direccion'] : NULL,
                        'created_at' => getTimestamp()
                    ];

                    $id_cliente = $this->Clientes_model->insertCliente($cliente_array);
                    if ($id_cliente > 0) {
                        $cliente = $this->Clientes_model->getClienteWhere(['email' => $post['email']]);
                    }
                }
                $monedero = $this->Monedero_model->getMonederoWhere(['cliente_id' => $cliente->id, 'estado' => true]);
                if (empty($monedero)) {
                    $this->CrearMonedero($cliente->id);
                    $monedero = $this->Monedero_model->getMonederoWhere(['cliente_id' => $cliente->id, 'estado' => true]);
                }
                $data_carrito = !empty($post['data_carrito']) ? json_decode($post['data_carrito']) : [];
                $this->GenerarVenta($data_carrito, $cliente->id);
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

        $productos = $this->Productos_model->getProductos($where_productos);
        $clientes = $this->Clientes_model->getClientes($where_clientes);
        $data = [
            'title' => 'Nueva Venta',
            'main_view' => 'ventas/ventas_new_view',
            'productos' => !empty($productos) ? $productos : [],
            'clientes' => !empty($clientes) ? $clientes : [],
            'js_content' => [
                '0' => 'layout/js/generalJS',
                '1' => 'ventas/js/VentasJS'
            ]
        ];
        return view('layout/layout_main_view', $data);
    }
    public function EditarVenta($id)
    {
        $post = $this->request->getPost();
        $data = [
            'main_view' => 'ventas/ventas_new_view'
        ];
        return view('layout/layout_main_view', $data);
    }
    public function EliminarVenta()
    {
        $post = $this->request->getPost();
        $data = [
            'main_view' => 'ventas/ventas_new_view'
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

    private function GenerarVenta($data_carrito, $id)
    {
        $nueva_venta = [];
    }

    public function NuevaVentaRuta()
    {
        $post = $this->request->getPost();

        if (!empty($post)) {
            $ruta = $this->Rutas_model->getRuta($post['ruta_id']);
            if (!empty($ruta)) {

                $metodo_pago_id = $post['metodo_pago'];
                $cliente_id = $post['cliente_id'];
                $monto_pagado = $post['monto_pagado'];
                $monto_venta = $post['data']['costoTotal'];
                $new_venta = [
                    'pagado' => $post['check_pago_total'] ? ($metodo_pago_id != 1 ? true : false) : false,
                    'estado' => true,
                    'repartidor_id' => $ruta->repartidor_id,
                    'ruta_id' => $ruta->id,
                    'total_venta' => $monto_venta,
                    'total_pagado' => $post['monto_pagado'],
                    'cliente_id' => $post['cliente_id'],
                    'created_at' => getTimestamp()
                ];

                $venta_id = InsertRowTable('ventas', $new_venta);
                $cajas_total = 0;
                if ($venta_id > 0) {
                    $productos = $post['data']['productos'];
                    if (!empty($productos)) {
                        foreach ($productos as $producto) {
                            $cajas_total += $producto['cantidad'];

                            $new_producto_venta = [
                                'precio' => $producto['precio'],
                                'cantidad' => $producto['cantidad'],
                                'producto_id' => $producto['id'],
                                'venta_id' => $venta_id,
                                'ruta_id' => $ruta->id,
                                'tipo_huevo' => $producto['tipo_huevo'],
                                'formato_huevo' => $producto['formato_huevo'],
                                'created_at' => getTimestamp()
                            ];

                            $producto_venta_id = InsertRowTable('productos_venta', $new_producto_venta);
                        }
                        UpdateRowTableByWhere('ventas', ['cajas_total' => $cajas_total, 'updated_at' => getTimestamp()], ['id' => $venta_id]);
                        $new_pago = [
                            'venta_id' => $venta_id,
                            'metodo_pago_id' => $post['metodo_pago'],
                            'created_at' => getTimestamp(),
                        ];

                        if ($post['check_pago_total'] == true) {
                            if ($metodo_pago_id != 1) {
                                $new_pago['monto_pago_actual'] = $post['data']['costoTotal'];
                            } else {
                                $new_pago['monto_pago_actual'] = 0;
                            }
                            $new_pago['monto_total'] = $post['data']['costoTotal'];
                            $new_pago['monto_pagado'] = $post['data']['costoTotal'];
                        } else {
                            if ($metodo_pago_id != 1) {
                                $new_pago['monto_pago_actual'] = $post['monto_pagado'];
                            } else {
                                $new_pago['monto_pago_actual'] = 0;
                            }
                            $new_pago['monto_total'] = $post['data']['costoTotal'];
                            $new_pago['monto_pagado'] = $post['monto_pagado'];
                        }
                        $pago_id = InsertRowTable('pagos_venta', $new_pago);
                        $rsp = $this->ModificarMonedero($metodo_pago_id, $cliente_id, $monto_venta, $monto_pagado);
                        if (!empty($rsp)) {
                            UpdateRowTableByWhere('clientes_ruta', ['estado_cliente_ruta_id' => 1], ['cliente_id' => $post['cliente_id'], 'ruta_id' => $ruta->id]);
                            UpdateRowTableByWhere('rutas', ['cajas_vendidas' => $cajas_total, 'updated_at' => getTimestamp()], ['id' => $ruta->id]);
                            return redirect('rutas/ver/'.$ruta->id);
                            $rsp = [
                                'tipo' => 'success',
                                'msg' => 'Venta registrada con éxito'
                            ];
                        } else {
                            $rsp = [
                                'tipo' => 'error',
                                'msg' => 'Venta registrada con éxito pero monedero no modificado'
                            ];
                        }
                    } else {
                        $rsp = [
                            'tipo' => 'error',
                            'msg' => 'No se han encontrado productos en Venta'
                        ];
                    }
                } else {
                    $rsp = [
                        'tipo' => 'error',
                        'msg' => 'Venta no fue registrada'
                    ];
                }
            } else {
                $rsp = [
                    'tipo' => 'error',
                    'msg' => 'Ruta no existe o fue eliminada'
                ];
            }
        } else {
            $rsp = [
                'tipo' => 'error',
                'msg' => 'Datos no recibidos por el servidor'
            ];
        }

        return json_encode($rsp);
    }

    public function ModificarMonedero($metodo_pago_id, $cliente_id, $monto_venta, $monto_pagado)
    {
        $monedero = $this->Monedero_model->getMonederoWhere(['estado' => true, 'eliminado' => false, 'cliente_id' => $cliente_id]);
        if (empty($monedero)) {
            $this->CrearMonederoCliente($cliente_id);
            $monedero = $this->Monedero_model->getMonederoWhere(['estado' => true, 'eliminado' => false, 'cliente_id' => $cliente_id]);
        }

        switch ($metodo_pago_id) {
            case 1: // Pago con saldo
                $monedero->saldo -= $monto_venta;
                $monedero->total_comprado += $monto_venta;
                $monedero->total_deuda += $monto_venta;
                $monedero->total_fiado += $monto_venta;
                break;

            case 2: // Pago en efectivo
                $monedero->total_efectivo += $monto_pagado;
                break;

            case 3: // Pago por transferencia
                $monedero->total_transferencia += $monto_pagado;
                break;

            case 4: // Pago por depósito
                $monedero->total_deposito += $monto_pagado;
                break;
        }

        // Actualizar el total pagado
        $monedero->total_pagado += $monto_pagado;
        $monedero->total_comprado += $monto_venta;
        $monedero->updated_at = getTimestamp();

        $rsp = $this->Monedero_model->updateMonedero($monedero, $monedero->id);
        return $rsp > 0 ? true : false;
    }

    public function CrearMonederoCliente($cliente_id)
    {
        $monedero = [
            'cliente_id' => $cliente_id,
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
        return $id_monedero;
    }
}
