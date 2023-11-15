<?php

namespace App\Controllers;

class DeudasController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Listado de Deudas',
            'main_view' => 'deudas/deudas_list_view',
            'js_content' => [
                '0' => 'layout/js/generalJS',
            ]
        ];
        return view('layout/layout_main_view', $data);
    }

    public function NuevaDeuda()
    {
        $post = $this->request->getPost();
        $data = [
            'title' => 'Formulario Nueva Deuda',
            'main_view' => 'deudas/deudas_new_view'
        ];
        return view('layout/layout_main_view', $data);
    }

    public function EditarDeuda($id)
    {
        $post = $this->request->getPost();
        $data = [
            'title' => 'Formulario Edición Deuda',
            'main_view' => 'deudas/deudas_edit_view'
        ];
        return view('layout/layout_main_view', $data);
    }
    public function EliminarDeuda()
    {
        $post = $this->request->getPost();
        $data = [
            //  'main_view' => 'Clientess/Clientess_new_view'
        ];
        return view('layout/layout_main_view', $data);
    }
    private function ValidaFields()
    {
    }
}
