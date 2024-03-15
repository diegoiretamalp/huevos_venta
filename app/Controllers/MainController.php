<?php

namespace App\Controllers;

class MainController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Menu',
            'main_view' => 'layout/menu_view'
        ];
        return view('layout/layout_main2_view', $data);
    }
    public function iconos()
    {

        $data = [
            'main_view' => 'layout/iconos_view'
        ];
        return view('layout/layout_main_view', $data);
    }
}
