<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class RutasFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $usuarioRol = USUARIO_ROL;
        if ($usuarioRol == 4) {
            return redirect()->to('/');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Puedes realizar acciones después de que la solicitud se ha procesado
    }
}
