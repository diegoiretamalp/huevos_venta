<?php

namespace App\Controllers;

use stdClass;

class ClientesController extends BaseController
{
    public function __construct()
    {
        $this->session = session();
        $this->Clientes_model = model('App\Models\Clientes_model');
        $this->Monedero_model = model('App\Models\Monedero_model');
        $this->Ventas_model = model('App\Models\Ventas_model');
    }
    public function index()
    {

        $empresa_id = $_SESSION['userdata']['empresa_id'];
        $where_clientes = [
            'cli.estado' => true,
            'cli.eliminado' => false,
            'cli.empresa_id' => $empresa_id
        ];
        $clientes = $this->Clientes_model->getClientes($where_clientes);
        if (!empty($clientes)) {
            foreach ($clientes as $key) {
                $cartera = GetCarteraCliente($key->id);
                $key->total_compra = !empty($cartera->total_compra) ? $cartera->total_compra : 0;
                $key->total_pagado = !empty($cartera->total_pagado) ? $cartera->total_pagado : 0;
                $key->cantidad_compras = !empty($cartera->total_ventas) ? $cartera->total_ventas : 0;
                $key->total_deuda = $key->total_compra - $key->total_pagado;
            }
        }
        $data = [
            'title' => 'Listado de Clientes',
            'main_view' => 'clientes/clientes_list_view',
            'clientes' => !empty($clientes) ? $clientes : [],
            'js_content' => [
                '0' => 'layout/js/generalJS',
                '1' => 'clientes/js/clientesJS'
            ]
        ];
        return view('layout/layout_main_view', $data);
    }
    public function VerCliente($id)
    {
        if (!is_numeric($id)) {
            $this->session->setflashdata("error_title", "Cliente No Encontrado");
            $this->session->setflashdata("error", "Cliente no existe o fue eliminado");
            return redirect('clientes/listado');
        }
        $cliente = $this->Clientes_model->getCliente($id);
        if (empty($cliente)) {
            $this->session->setflashdata("error_title", "Cliente No Encontrado");
            $this->session->setflashdata("error", "Cliente no existe o fue eliminado");
            return redirect('clientes/listado');
        }
        $where_ventas = [
            'estado' => true,
            'eliminado' => false,
            'cliente_id' => $id

        ];
        $ventas = $this->Ventas_model->getVentas($where_ventas);
        $cartera = GetCarteraCliente($cliente->id);
        // pre_die($cartera->precio_f)
        $cliente->nombre_producto = GetRowObjectByWhere('productos', ['estado' => true, 'eliminado' => false, 'id' => $cliente->producto_id])->nombre;
        // pre_die($cartera);
        $data = [
            'title' => 'Ver Cliente',
            'main_view' => 'clientes/clientes_ver_view',
            'cliente' => !empty($cliente) ? $cliente : [],
            'ventas' => !empty($ventas) ? $ventas : [],
            'cartera' => !empty($cartera) ? $cartera  : [],
            'js_content' => [
                '0' => 'layout/js/generalJS',
                '1' => 'clientes/js/clientesVerJS'
            ]
        ];
        return view('layout/layout_main_view', $data);
    }

    public function NuevoCliente()
    {
        $post = $this->request->getPost();

        if (!empty($post)) {
            if ($validate = $this->validateField($post)) {
                $this->session->setflashdata("error_title", "Error de Validación");
                $this->session->setflashdata("error", "Se encontraron los siguientes errores: " . implode(", ", $validate));
                $this->session->setflashdata("errores", $post);
                return redirect('clientes/nuevo');
            } else {

                $sector = GetObjectRowByWhere('sectores', ['id' => !empty($post['sector_id']) ? $post['sector_id'] : '']);
                if (!empty($sector)) {
                    $comuna = GetObjectRowByWhere('comunas', ['id' => !empty($sector) ? $sector->comuna_id : '']);
                }

                $cliente_array = [
                    'nombre_negocio' => !empty($post['nombre_negocio']) ? $post['nombre_negocio'] : NULL,
                    'nombre' => !empty($post['nombre']) ? $post['nombre'] : NULL,
                    'tipo_huevo' => !empty($post['tipo_huevo']) ? $post['tipo_huevo'] : NULL,
                    'apellido_paterno' => !empty($post['apellido_paterno']) ? $post['apellido_paterno'] : NULL,
                    'apellido_materno' => !empty($post['apellido_materno']) ? $post['apellido_materno'] : NULL,
                    'rut_factura' => !empty(!empty($post['rut_factura'])) ? $post['rut_factura'] : NULL,
                    'celular' => !empty($post['celular']) ? $post['celular'] : NULL,
                    'email' => !empty($post['email']) ? $post['email'] : NULL,
                    'precio_favorito' => !empty($post['precio_favorito']) ? $post['precio_favorito'] : NULL,
                    'producto_id' => !empty($post['producto_id']) ? $post['producto_id'] : NULL,
                    'estado' => true,
                    'region_id' => !empty($comuna) ? $comuna->region_id : NULL,
                    'comuna_id' => !empty($comuna) ? $comuna->id : NULL,
                    'sector_id' => !empty($post['sector_id']) ? $post['sector_id'] : NULL,
                    'direccion' => !empty($post['direccion']) ? $post['direccion'] : NULL,
                    'created_at' => getTimestamp()
                ];


                $id_cliente = $this->Clientes_model->insertCliente($cliente_array);

                if ($id_cliente > 0) {
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
                    if ($id_monedero > 0) {
                        $this->session->setflashdata("success_title", "Gestión de Clientes");
                        $this->session->setflashdata("success", "Se ha realizado la creación de un nuevo Cliente correctamente.");
                        return redirect('clientes/listado');
                    } else {
                        $this->session->setflashdata("warning_title", "Gestión de Clientes");
                        $this->session->setflashdata("warning", "Se ha realizado la creación de un nuevo Cliente correctamente. NO se creó el monedero del Cliente, crear manualmente por favor.");
                        return redirect('clientes/listado');
                    }
                } else {
                    $this->session->setflashdata("error_title", "Error Interno");
                    $this->session->setflashdata("error", "Ha Ocurrido un problema al crear el cliente. Intentelo Nuevamente, si el problema persiste contácte a Soporte");
                    $this->session->setflashdata("errores", $post);
                    return redirect(base_url('clientes/nuevo'));
                }
            }
        }

        $regiones = GetObjectByWhere('regiones', ['estado' => true]);
        $productos = GetObjectByWhere('productos', ['estado' => true, 'eliminado' => false]);
        $comunas = GetObjectByWhere('comunas', ['estado' => true]);
        $sectores = GetObjectByWhere('sectores', ['estado' => true, 'eliminado' => false]);

        $data = [
            'title' => 'Formulario de Nuevo Cliente',
            'productos' => !empty($productos) ? $productos : [],
            'comunas' => !empty($comunas) ? $comunas : [],
            'regiones' => !empty($regiones) ? $regiones : [],
            'sectores' => !empty($sectores) ? $sectores : [],
            'main_view' => 'clientes/clientes_new_view',
            'action' => base_url('clientes/nuevo'),
            'js_content' => [
                '0' => 'layout/js/generalJS',
                '1' => 'login/js/validate_rut',
                '2' => 'clientes/js/ClientesNewJS'
            ]
        ];
        return view('layout/layout_main_view', $data);
    }

    public function EditarCliente($id)
    {
        $post = $this->request->getPost();

        if (!empty($post)) {
            if ($validate = $this->validateField($post)) {
                $this->session->setflashdata("error_title", "Error de Validación");
                $this->session->setflashdata("error", "Se encontraron los siguientes errores: " . implode(", ", $validate));
                $this->session->setflashdata("errores", $post);
                return redirect('clientes/nuevo');
            } else {

                $array_update = [
                    'nombre_negocio' => !empty($post['nombre_negocio']) ? $post['nombre_negocio'] : NULL,
                    'nombre' => !empty($post['nombre']) ? $post['nombre'] : NULL,
                    'tipo_huevo' => !empty($post['tipo_huevo']) ? $post['tipo_huevo'] : NULL,
                    'apellido_paterno' => !empty($post['apellido_paterno']) ? $post['apellido_paterno'] : NULL,
                    'apellido_materno' => !empty($post['apellido_materno']) ? $post['apellido_materno'] : NULL,
                    'rut_factura' => !empty(!empty($post['rut_factura'])) ? $post['rut_factura'] : NULL,
                    'celular' => !empty($post['celular']) ? $post['celular'] : NULL,
                    'email' => !empty($post['email']) ? $post['email'] : NULL,
                    'precio_favorito' => !empty($post['precio_favorito']) ? $post['precio_favorito'] : NULL,
                    'producto_id' => !empty($post['producto_id']) ? $post['producto_id'] : NULL,
                    'estado' => !empty($post['estado']) ? ($post['estado'] == '1' ? true : false) : FALSE,
                    'region_id' => !empty($comuna) ? $comuna->region_id : NULL,
                    'comuna_id' => !empty($comuna) ? $comuna->id : NULL,
                    'sector_id' => !empty($post['sector_id']) ? $post['sector_id'] : NULL,
                    'direccion' => !empty($post['direccion']) ? $post['direccion'] : NULL,
                    'updated_at' => getTimestamp()
                ];
                // pre_die($array_update);
                $id_cliente = $this->Clientes_model->updateCliente($array_update, $id);
                if ($id_cliente > 0) {
                    $this->session->setflashdata("success_title", "Gestión de Clientes");
                    $this->session->setflashdata("success", "Se ha editado el cliente correctamente.");
                    return redirect('clientes/listado');
                } else {
                    $this->session->setflashdata("error_title", "Error Interno");
                    $this->session->setflashdata("error", "Ha Ocurrido un problema al crear el cliente. Intentelo Nuevamente, si el problema persiste contácte a Soporte");
                    $this->session->setflashdata("errores", $post);
                    return redirect(base_url('clientes/nuevo'));
                }
            }
        }
        $regiones = GetObjectByWhere('regiones', ['estado' => true]);
        $productos =  GetObjectByWhere('productos', ['estado' => true, 'eliminado' => false]);
        $clientes = $this->Clientes_model->getCliente($id);
        $comunas = GetObjectByWhere('comunas', ['estado' => true]);
        $sector = GetObjectByWhere('sectores', ['estado' => true, 'eliminado' => false]);
        $data = [
            'title' => 'Formulario de Edicion Cliente',
            'action' => base_url('clientes/editar/' . $id),
            'cliente' => !empty($clientes) ? $clientes : [],
            'comunas' => !empty($comunas) ? $comunas : [],
            'sectores' => !empty($sector) ? $sector : [],
            'productos' => !empty($productos) ? $productos : [],
            'regiones' => !empty($regiones) ? $regiones : [],
            'main_view' => 'clientes/clientes_edit_view',
            'js_content' => [
                '0' => 'layout/js/generalJS',
                '1' => 'clientes/js/clientesJS'
            ]
        ];
        return view('layout/layout_main_view', $data);
    }
    public function EliminarCliente()
    {
        $post = $this->request->getPost();
        if (!empty($post)) {
            $id = $post['cliente_id'];
            $where = [
                'id' => $id,
                'eliminado' => false,
            ];

            $arr_data = [
                'eliminado' => true,
                'deleted_at' => getTimestamp(),
            ];

            $cliente = $this->Clientes_model->getClienteWhere($where);

            if (empty($cliente)) {
                echo false;
            } else {
                $deleted = $this->Clientes_model->deleteCliente($arr_data, $id);
                if ($deleted) {
                    echo true;
                } else {
                    echo false;
                }
            }
        } else {
            echo false;
        }
    }

    protected function validateField($data)
    {
        $error = [];
        $error_flag = false;

        if (validateText(trim($data['nombre']))) {
            $error_flag = true;
            $error['nombre'] = 'Nombre';
        }

        if (validateText(trim($data['nombre_negocio']))) {
            $error_flag = true;
            $error['nombre_negocio'] = 'Nombre del Negocio';
        }



        if (!empty($data['apellido_paterno'])) {
            if (validateText(trim($data['apellido_paterno']))) {
                $error_flag = true;
                $error['apellido_paterno'] = 'Apellido Paterno';
            }
        }
        if (!empty($data['apellido_materno'])) {
            if (validateText(trim($data['apellido_materno']))) {
                $error_flag = true;
                $error['apellido_materno'] = 'Apellido Materno';
            }
        }
        if (!empty($data['email'])) {
            if (validateEmail(trim($data['email']))) {
                $error_flag = true;
                $error['email'] = 'Correo electrónico';
            }
        }

        if (!validateRut(trim($data['rut_factura']))) {
            $error_flag = true;
            $error['rut_factura'] = 'Rut Inválido';
        }

        // if (!empty($data['celular'])) {
        //     if (!is_numeric(trim($data['celular']))) {
        //         $error_flag = true;
        //         $error['celular'] = 'Celular';
        //     } else {
        //         if (strlen($data['celular']) != 11) {
        //             $error_flag = true;
        //             $error['celular'] = 'Celular';
        //         }
        //     }
        // }

        // if (empty($data['comuna_id']) || $data['comuna_id'] == 0) {
        //     $error_flag = true;
        //     $error['comuna_id'] = 'Comuna';
        // }

        if (!empty($data['sector_id']) && $data['sector_id'] == 0) {
            $error_flag = true;
            $error['sector_id'] = 'Sector';
        }

        if (empty($data['producto_id']) || $data['producto_id'] == 0) {
            $error_flag = true;
            $error['producto_id'] = 'Producto';
        }

        if (validateText(trim($data['direccion']))) {
            $error_flag = true;
            $error['direccion'] = 'Direccion';
        }

        if ($error_flag) {
            return $error;
        } else {
            return false;
        }
    }
}
