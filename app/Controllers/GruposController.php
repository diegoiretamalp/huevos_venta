<?php

namespace App\Controllers;

class GruposController extends BaseController
{

    public function __construct()
    {
        $this->session = session();
        // $this->_model = model('App\Models\Sectores_model');
    }
    public function index()
    {

        $where_grupos = [
            'estado' => true,
            'deleted' => false,
        ];
        $grupos = GetObjectByWhere('grupos', $where_grupos);
        // $comunas = GetObjectByWhere('comunas', ['estado' => true]);
        $data = [
            'title' => 'Listado de Sectores',
            'main_view' => 'grupos/grupos_list_view',
            'grupos' => !empty($grupos) ? $grupos : [],
            'js_content' => [
                '0' => 'layout/js/generalJS',
                '1' => 'grupos/js/GruposJS'
            ]
        ];
        return view('layout/layout_main_view', $data);
    }
    public function NuevoGrupo()
    {
        $post = $this->request->getPost();

        if (!empty($post)) {
            // $this->session->setflashdata("error_title", "Error de Validación");
            // $this->session->setflashdata("error", "Se encontraron los siguientes errores: " . implode(", ", $validate));
            // $this->session->setflashdata("errores", $post);
            // return redirect('grupos/nuevo');
            if (!empty($post['clientes_grupo'])) {
                // pre($post);
                // pre_die();
                $new_grupo = [
                    'nombre' => !empty($post['nombre']) ? $post['nombre'] : null,
                    'created_at' => getTimestamp(),
                ];
                $grupo_id = InsertRowTable('grupos', $new_grupo);

                $clientes = json_decode($post['clientes_grupo']);
                foreach ($clientes as $key) {
                    $cliente_grupo = [
                        'cliente_id' => !empty($key->id) ? $key->id : null,
                        'grupo_id' => $grupo_id,
                        'created_at' => getTimestamp(),
                    ];
                    InsertRowTable('grupo_clientes', $cliente_grupo);
                }
                if ($grupo_id > 0) {
                    $this->session->setflashdata("success_title", "Mantenedor de Grupos");
                    $this->session->setflashdata("success", "Se ha creado el Grupo con éxito!");
                    return redirect('grupos/listado');
                } else {
                    $this->session->setflashdata("error_title", "Error de Validación");
                    $this->session->setflashdata("error", "Se encontraron los siguientes errores: ");
                    $this->session->setflashdata("errores", $post);
                    return redirect('grupos/nuevo');
                }
            } else {
                $this->session->setflashdata("error_title", "Mantenedor de Grupos");
                $this->session->setflashdata("error", "Error al crear el grupo!");
                return redirect('grupos/nuevo');
            }
        }

        $clientes = GetObjectByWhere('clientes', ['estado' => true, 'eliminado' => false]);
        $comunas = GetObjectByWhere('comunas', ['estado' => true]);

        $data = [
            'title' => 'Nuevo Grupo',
            'main_view' => 'grupos/grupos_new_view',
            'clientes' => !empty($clientes) ? $clientes : [],
            'comunas' => !empty($comunas) ? $comunas : [],
            'js_content' => [
                '0' => 'layout/js/generalJS',
                '1' => 'grupos/js/GruposNewJS'
            ]
        ];
        return view('layout/layout_main_view', $data);
    }
    public function EditarGrupo($grupo_id)
    {
        if (!is_numeric($grupo_id)) {
            $this->session->setflashdata("error_title", "Error de Validación");
            $this->session->setflashdata("error", "Grupo no existe o fué eliminado.");
            return redirect('grupos/listado');
        }
        $grupo = GetRowObjectByWhere('grupos', ['estado' => true, 'deleted' => false, 'id' => $grupo_id]);
        if (empty($grupo)) {
            $this->session->setflashdata("error_title", "Error de Validación");
            $this->session->setflashdata("error", "Grupo no existe o fué eliminado.");
            return redirect('grupos/listado');
        }
        $post = $this->request->getPost();
        if (!empty($post)) {
            $clientes_grupo = json_decode($post['clientes_grupo']);
            // pre_die($clientes_grupo);
            if (!empty($post['clientes_grupo'])) {
                $update_grupo = [
                    'nombre' => !empty($post['nombre']) ? $post['nombre'] : null,
                    'updated_at' => getTimestamp(),
                ];
                $update_id = UpdateRowTableByWhere('grupos', $update_grupo, ['id' => $grupo->id]);
                $update_grupo_clientes = [
                    'grupo_id' => $grupo->id,
                    'estado' => false,
                    'deleted' => true,
                    'updated_at' => getTimestamp(),
                    'deleted_at' => getTimestamp(),
                ];
                $update_clientes_id = UpdateRowTableByWhere('grupo_clientes', $update_grupo_clientes, ['grupo_id' => $grupo->id]);

                $clientes_grupo = json_decode($post['clientes_grupo']);
                // pre_die($clientes_grupo);
                foreach ($clientes_grupo as $key) {
                    $cliente_grupo = [
                        'cliente_id' => !empty($key->id) ? $key->id : null,
                        'grupo_id' => $grupo->id,
                        'created_at' => getTimestamp(),
                    ];
                    InsertRowTable('grupo_clientes', $cliente_grupo);
                }
                if ($update_id > 0 && $update_clientes_id > 0) {
                    $this->session->setflashdata("success_title", "Mantenedor de Grupos");
                    $this->session->setflashdata("success", "Se ha creado el Grupo con éxito!");
                    return redirect('grupos/listado');
                } else {
                    $this->session->setflashdata("error_title", "Error de Validación");
                    $this->session->setflashdata("error", "Se encontraron los siguientes errores: ");
                    $this->session->setflashdata("errores", $post);
                    return redirect('grupos/nuevo');
                }
            } else {
                $this->session->setflashdata("error_title", "Mantenedor de Grupos");
                $this->session->setflashdata("error", "Error al crear el grupo!");
                return redirect('grupos/nuevo');
            }
        }

        $clientes = GetObjectByWhere('clientes', ['estado' => true, 'eliminado' => false]);
        $comunas = GetObjectByWhere('comunas', ['estado' => true]);
        // pre_die($grupo);

        $clientes_grupo = GetObjectByWhere('grupo_clientes', ['estado' => true, 'deleted' => false, 'grupo_id' => $grupo->id]);
        $clientes_grupo_return = [];
        if (!empty($clientes_grupo)) {
            foreach ($clientes_grupo as $key) {
                $cliente = GetRowObjectByWhere('clientes', ['estado' => true, 'eliminado' => false, 'id' => $key->cliente_id]);
                if (!empty($cliente)) {
                    $cliente_data = [
                        'id' => $cliente->id,
                        'posicion' => 1,
                        'cliente_data' => $cliente,
                    ];
                    $clientes_grupo_return[] = $cliente_data;
                }
            }
        }
        // pre_die($clientes_grupo_return);
        $data = [
            'title' => 'Editar Grupo',
            'main_view' => 'grupos/grupos_edit_view',
            'action' => base_url('grupos/editar/' . $grupo->id),
            'clientes' => !empty($clientes) ? $clientes : [],
            'comunas' => !empty($comunas) ? $comunas : [],
            'grupo' => !empty($grupo) ? $grupo : [],
            'clientes_grupo' => !empty($clientes_grupo_return) ? $clientes_grupo_return : [],
            'js_content' => [
                '0' => 'layout/js/generalJS',
                '1' => 'grupos/js/GruposEditJS'
            ]
        ];
        return view('layout/layout_main_view', $data);
    }

    public function EliminarGrupo()
    {
        $post = $this->request->getPost();

        if (!empty($post)) {
            $id = $post['grupo_id'];
            $where = [
                'id' => $id,
                'deleted' => false,
            ];

            $arr_data = [
                'deleted' => true,
                'deleted_at' => getTimestamp(),
            ];

            $grupo = GetRowObjectByWhere('grupos', $where);

            if (empty($grupo)) {
                echo false;
            } else {
                $clientes_grupo = GetObjectByWhere('grupo_clientes', ['grupo_id' => $grupo->id, 'deleted' => false]);
                $deleted = UpdateRowTableByWhere('grupos', $arr_data, $where);
                if ($deleted) {
                    if ($clientes_grupo) {
                        $arr_cli = [
                            'deleted' => true,
                            'estado' => false,
                            'updated_at' => getTimestamp(),
                            'deleted_at' => getTimestamp(),
                        ];
                        $deleted_clientes = UpdateRowTableByWhere('grupo_clientes', $arr_cli, ['grupo_id' => $grupo->id]);
                    }
                    echo true;
                } else {
                    echo false;
                }
            }
        } else {
            echo false;
        }
    }

    // private function ValidaFields($data)
    // {
    //     $error = [];
    //     $error_flag = false;

    //     if ($data['cliente_id'] < 0) {
    //         $error_flag = true;
    //         $error['cliente_id'] = 'Seleccionar Cliente';
    //     }
    //     if ($data['cliente_id'] == 0) {
    //         if (validateText(trim($data['nombre']))) {
    //             $error_flag = true;
    //             $error['nombre'] = 'Nombre';
    //         }
    //         if (validateText(trim($data['apellido_paterno']))) {
    //             $error_flag = true;
    //             $error['apellido_paterno'] = 'Apellido Paterno';
    //         }
    //         if (validateText(trim($data['apellido_materno']))) {
    //             $error_flag = true;
    //             $error['apellido_materno'] = 'Apellido Materno';
    //         }

    //         if (!validateRut(trim($data['rut_factura']))) {
    //             $error_flag = true;
    //             $error['rut_factura'] = 'Rut Inválido';
    //         }

    //         if (!empty($data['celular'])) {
    //             if (!is_numeric(trim($data['celular']))) {
    //                 $error_flag = true;
    //                 $error['celular'] = 'Celular';
    //             } else {
    //                 if (strlen($data['celular']) != 11) {
    //                     $error_flag = true;
    //                     $error['celular'] = 'Celular';
    //                 }
    //             }
    //         }

    //         if (validateEmail(trim($data['email']))) {
    //             $error_flag = true;
    //             $error['email'] = 'Correo electrónico';
    //         }

    //         if (!empty($data['direccion'])) {
    //             if (validateText(trim($data['direccion']))) {
    //                 $error_flag = true;
    //                 $error['nombre'] = 'Nombre';
    //             }
    //         }
    //     }

    //     if (empty($data['data_carrito'])) {
    //         $error_flag = true;
    //         $error['data_carrito'] = 'No se han seleccionado productos para la venta';
    //     }
    //     $data_carrito = json_decode($data['data_carrito']);
    //     if (count($data_carrito) <= 0) {
    //         $error_flag = true;
    //         $error['data_carrito'] = 'No se han seleccionado productos para la venta';
    //     }
    //     if (empty($data['metodo_pago'])) {
    //         $error_flag = true;
    //         $error['metodo_pago'] = 'No se ha seleccionado un metodo de pago';
    //     }
    //     if (!is_numeric($data['costo_total'])) {
    //         $error_flag = true;
    //         $error['costo_total'] = 'No se ha obtenido el Total de la Venta';
    //     }

    //     if (!isset($data['check_pago_total'])) {
    //         if (empty(trim($data['monto_pagado']))) {
    //             $error_flag = true;
    //             $error['monto_pagado'] = 'No se ha indicado el monto pagado';
    //         }
    //         if (!is_numeric($data['monto_pagado'])) {
    //             $error_flag = true;
    //             $error['monto_pagado'] = 'No se ha indicado el monto pagado';
    //         }

    //         if ($data['monto_pagado'] > $data['costo_total']) {
    //             $error_flag = true;
    //             $error['monto_pagado'] = 'El monto pagado no puede ser mayor al costo total de la venta.';
    //         }
    //     }


    //     if ($error_flag) {
    //         return $error;
    //     } else {
    //         return false;
    //     }
    // }
}
