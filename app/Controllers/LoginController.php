<?php

namespace App\Controllers;

class LoginController extends BaseController
{
    public function __construct()
    {
        $this->session = session();
        $this->Usuarios_model = model('App\Models\Usuarios_model');
        
    }
    public function index()
    {
        $post = $this->request->getPost();
        if (!empty($post)) {
            if (
                empty($post['rut']) && !isset($post['rut']) &&
                empty($post['password']) && !isset($post['password'])
            ) {
                $this->session->setflashdata("error_title", "Error de Validación");
                $this->session->setflashdata("error", "Rut y Contraseña son obligatorios. Corrija e Intente Nuevamente");
                return redirect('login');
            } else {


                $where = [
                    'rut' => str_replace('.', '', $post['rut']),
                    'eliminado' => false,
                ];
                //pre_die('No se pudo conectar a la base de datos');
                $usuario = $this->Usuarios_model->getUsuarioWhere($where);


                //pre_die($usuario);
                if (empty($usuario)) {
                    $this->session->setflashdata("error_title", "Error de Validación");
                    $this->session->setflashdata("error", "Rut y/o Clave incorrectas, corregir e intentar nuevamente");
                    return redirect('login');
                } else {
                    //pre_die(sha1($post['password']));
                    if (sha1($post['password']) != $usuario->password) {
                        $this->session->setflashdata("error_title", "Error de Validación");
                        $this->session->setflashdata("error", "Rut y/o Clave incorrectas, corregir e intentar nuevamente");
                        return redirect('login');
                    }
                    if ($usuario->estado == 0) {
                        $this->session->setflashdata("error_title", "Error de Validación");
                        $this->session->setflashdata("error", "Su Usuario a sido Deshabilitado. <br>¿Tiene dudas? Contáctenos: <strong >Contacto@HighDevs.cl</strong>");
                        return redirect('login');
                    } elseif ($usuario->estado == 1) {
                        $token = sha1(mt_rand());

                        $rsp = $this->Usuarios_model->updateUsuario(['remember_token' => $token], $usuario->id);
                        //pre_die($rsp);
                        if ($rsp == 0) {
                            $this->session->setflashdata("error_title", "Error interno");
                            $this->session->setflashdata("error", "Rut y/o Clave incorrectas, corregir e intentar nuevamente");
                            return redirect('login');
                        }


                        $data = [
                            'token_usuario' => $token,
                            'habilitado' => true,
                            'perfil' => $usuario->perfil_id,
                        ];

                        $_SESSION['userdata'] = $data;

                        if ($usuario->validate_password == 1) {
                            return redirect('cambio-contrasena');
                        } else {
                            return redirect('/');
                        }
                    } else {
                        $this->session->setflashdata("error_title", "Error de Validación");
                        $this->session->setflashdata("error", "Usuario deshabilitado. Corrija e Intente Nuevamente");
                        return redirect('login');
                    }
                }
            }
        }

        $data = [
            'main_view' => 'login/login_new_view',
            'js_content' => [
                '0' => 'login/js/validate_rut',
                // '0' => 'layout/js/generalJS',
                '1' => 'login/js/LoginJS'
            ]
        ];
        return view('layout/layout_nologin_view', $data);
    }

    public function restablecer_password()
    {
        $post = $this->request->getPost();
        if (!empty($post)) {
            if (
                empty($post['rut']) && !isset($post['rut']) &&
                empty($post['password']) && !isset($post['password'])
            ) {
                $this->session->setflashdata("error_title", "Error de Validación");
                $this->session->setflashdata("error", "Rut y Contraseña son obligatorios. Corrija e Intente Nuevamente");
                return redirect('login');
            } else {


                $where = [
                    'rut' => strUpper($post['rut']),
                    'eliminado' => false,
                ];
                //pre_die('No se pudo conectar a la base de datos');
                $usuario = $this->Usuarios_model->getUsuarioWhere($where);


                //pre_die($usuario);
                if (empty($usuario)) {
                    $this->session->setflashdata("error_title", "Error de Validación");
                    $this->session->setflashdata("error", "Rut y/o Clave incorrectas, corregir e intentar nuevamente");
                    return redirect('login');
                } else {
                    if (sha1($post['password']) != $usuario->password) {
                        $this->session->setflashdata("error_title", "Error de Validación");
                        $this->session->setflashdata("error", "Rut y/o Clave incorrectas, corregir e intentar nuevamente");
                        return redirect('login');
                    }

                    if ($usuario->estado == 0) {
                        $this->session->setflashdata("error_title", "Error de Validación");
                        $this->session->setflashdata("error", "Su Usuario a sido Deshabilitado. <br>¿Tiene dudas? Contáctenos: <strong >Contacto@HighDevs.cl</strong>");
                        return redirect('login');
                    } elseif ($usuario->estado == 1) {
                        $token = sha1(mt_rand());

                        $rsp = $this->Usuarios_model->updateUsuario(['remember_token' => $token], $usuario->id);
                        //pre_die($rsp);
                        if ($rsp == 0) {
                            $this->session->setflashdata("error_title", "Error interno");
                            $this->session->setflashdata("error", "Rut y/o Clave incorrectas, corregir e intentar nuevamente");
                            return redirect('login');
                        }


                        $data = [
                            'token_usuario' => $token,
                            'habilitado' => true,
                            'perfil' => $usuario->perfil_id,
                        ];

                        $_SESSION['userdata'] = $data;

                        if ($usuario->valida_password == 1) {
                            return redirect('cambio-contrasena');
                        } else {
                            return redirect('menu');
                        }
                    } else {
                        $this->session->setflashdata("error_title", "Error de Validación");
                        $this->session->setflashdata("error", "Usuario deshabilitado. Corrija e Intente Nuevamente");
                        return redirect('login');
                    }
                }
            }
        }
        $data = array(
            'title' => 'Restablecer Contraseña',
            'action' => base_url('login/restablecer-password'),
            'main_view' => 'login/login_restablecer_password_view'
        );
        return view('layout/layout_nologin_view', $data);
    }

    public function cambiar_password()
    {
        // $session = session();
        $post = $this->request->getPost();
        if (!empty($post)) {
            pre_die($post);
        }
        $data = array(
            'title' => 'Cambiar Contraseña',
            'action' => base_url('login/cambiar-password'),
            'main_view' => 'login/login_cambiar_password_view'
        );
        return view('layout/layout_nologin_view', $data);
    }

    public function SesionFinaliza(){
        $session = session();

        $session->destroy();
        $data = array(
            'title' => 'Su sesión a Expirado',
            'action' => base_url('sesion-finalizada'),
            'alerta' => 'Esto debido a Inactividad o Inicio de Sesión desde otro dispositivo',
            'main_view' => 'login/session_finalizada_view'
        );

        return view('layout/layout_nologin_view', $data);
    }
    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect('login');
    }
    private function ValidaFields($data)
    {
        $error = [];
        $error_flag = false;


        if (!empty($data['rut'])) {
            if (validateText(trim($data['rut']))) {
                $error_flag = true;
                $error['rut'] = 'rut';
            }
        }
        if (!empty($data['password'])) {
            if (validateText(trim($data['password']))) {
                $error_flag = true;
                $error['password'] = 'password';
            }
        }

        if ($error_flag) {
            return $error;
        } else {
            return false;
        }
    }
}
