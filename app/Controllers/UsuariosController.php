<?php

namespace App\Controllers;

class UsuariosController extends BaseController
{
    public function __construct()
    {
        $this->session = session();
        $this->Productos_model = model('App\Models\Productos_model');
        $this->Clientes_model = model('App\Models\Clientes_model');
        $this->Usuarios_model = model('App\Models\Usuarios_model');
    }
    public function index()
    {

        $where_usuarios = [
            'estado' => true,
            'eliminado' => false,
            //'mostrar' => true,
        ];
        /*if(USUARIO_ROL == 2){
            $where_usuarios['id!='] = USUARIO_ID;
        }*/
        $usuarios = $this->Usuarios_model->getUsuarios($where_usuarios);

        $data = [
            'title' => 'Listado de Usuarios',
            'main_view' => 'usuarios/usuarios_list_view',
            'usuarios' => !empty($usuarios) ? $usuarios : [],
            'js_content' => [
                '0' => 'layout/js/generalJS'
            ]
        ];
        return view('layout/layout_main_view', $data);
    }
    public function NuevoUsuario()
    {
        $post = $this->request->getPost();

        if (!empty($post)) {
            if ($validate = $this->validateFields($post)) {
                $this->session->setflashdata("error_title", "Error de Validación");
                $this->session->setflashdata("error", "Se encontraron los siguientes errores: " . implode(", ", $validate));
                $this->session->setflashdata("errores", $post);
                return redirect('usuarios/nuevo');
            } else {

                $usuario_array = [
                    'nombre' => !empty($post['nombre']) ? $post['nombre'] : NULL,
                    'rut' => !empty($post['rut']) ? $post['rut'] : NULL,
                    'celular' => !empty($post['celular']) ? $post['celular'] : NULL,
                    'email' => !empty($post['email']) ? $post['email'] : NULL,
                    'estado' => false,
                    'perfil_id' => !empty($post['perfil_id']) ? $post['perfil_id'] : NULL,
                    'direccion' => !empty($post['direccion']) ? $post['direccion'] : NULL,
                    'password' => sha1(1234),
                    'validate_password' => true,
                    'created_at' => getTimestamp()
                ];

                $id_usuario = $this->Usuarios_model->insertUsuario($usuario_array);
                if ($id_usuario > 0) {
                    $this->session->setflashdata("success_title", "Gestión de Usuarios");
                    $this->session->setflashdata("success", "Se ha realizado la creación del nuevo usuario correctamente.");
                    return redirect('usuarios/listado');
                } else {
                    $this->session->setflashdata("error_title", "Error Interno");
                    $this->session->setflashdata("error", "Ha Ocurrido un problema al crear el usuario. Intentelo Nuevamente, si el problema persiste contácte a Soporte");
                    $this->session->setflashdata("errores", $post);
                    return redirect(base_url('usuarios/nuevo'));
                }
            }
        }

        $data = [
            'title' => 'Nuevo Usuario',
            'action' => base_url('usuarios/nuevo'),
            'main_view' => 'usuarios/usuarios_new_view',
            'usuarios' => !empty($usuario) ? $usuario : [],
            'js_content' => [
                '0' => 'layout/js/generalJS',
                '1' => 'usuarios/js/UsuariosJS'
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
    protected function validateFields($data)
    {
        $error = [];
        $error_flag = false;

        if (validateText(trim($data['nombre']))) {
            $error_flag = true;
            $error['nombre'] = 'Nombre';
        }

        if (validateEmail(trim($data['email']))) {
            $error_flag = true;
            $error['email'] = 'Correo electrónico';
        }

        if (!validateRut(trim($data['rut']))) {
            $error_flag = true;
            $error['rut'] = 'Rut Inválido';
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

        /*if (validatePassword($data['password'])) {
            $error_flag = true;
            $error['password'] = 'Contraseña';
        }
        if (validatePassword($data['password_confirm'])) {
            $error_flag = true;
            $error['password_confirm'] = 'Confirmar Contraseña';
        }
        if ($data['password'] != $data['password_confirm']) {
            $error_flag = true;
            $error['password'] = 'Contraseñas No coinciden ';
        }
        if ($error_flag) {
            return $error;
        } else {
            return false;
        }*/

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
