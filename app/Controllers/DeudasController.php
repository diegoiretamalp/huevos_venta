<?php
//hhola
namespace App\Controllers;

class DeudasController extends BaseController
{
    public function __construct()
    {
        $this->session = session();
        $this->Ventas_model = model('App\Models\Ventas_model');
    }
    public function index()
    {

        $where_venta = [
            'v.estado' => true,
            'v.pagado' => false,
            'v.eliminado' => false
        ];

        $deudas = $this->Ventas_model->GetVentasDetalle($where_venta);
      
        $data = [
            'title' => 'Listado de Deudas',
            'main_view' => 'deudas/deudas_list_view',
            'deudas' => !empty($deudas) ? $deudas : [],
            'js_content' => [
                '0' => 'layout/js/generalJS',
                '1' => 'deudas/js/deudasJS'
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
