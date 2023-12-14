<?php

namespace App\Controllers;

class ErroresController extends BaseController
{
    public function __construct()
    {}

    public function error404()
    {
        return redirect('/'); // Puedes cargar una vista específica para el error 404
    }
}
