<?php

namespace App\Controllers;

class LoginController extends BaseController
{
    public function __construct()
    {
        $this->session = session();
    }
    public function index()
    {

        $data = [
            'main_view' => 'login/login_new_view'
        ];
        return view('layout/layout_main_view', $data);
    }

    public function restablecer_password()
    {
        // $session = session();
        $post = $this->request->getPost();
        if (!empty($post)) {

            pre_die($post);
        }
        $data = array(
            'title' => 'Restablecer Contraseña',
            'action' => base_url('login/restablecer-password'),
            'main_view' => 'login/login_restablecer_password_view'
        );
        return view('layout/layout_main_view', $data);
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
        return view('layout/layout_main_view', $data);
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
