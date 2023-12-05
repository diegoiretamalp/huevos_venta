<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use FTP\Connection;
use PDOException;

class Auth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $db      = \Config\Database::connect();
        $session = session();
        if (!empty($_SESSION['userdata']['token_usuario'])) {
            $usuario = $db->table('usuarios');
            $token = $_SESSION['userdata']['token_usuario'];
            $where['remember_token'] = $token;
            $usuarioLogin = $usuario->getWhere($where)->getRowArray();
            if (!empty($usuarioLogin)) {
                define('USUARIO_ID', $usuarioLogin['id']);
                define('USUARIO_NOMBRE', !empty($usuarioLogin['nombre']) ? $usuarioLogin['nombre'] : 'Demo');
                define('USUARIO_MAIL', $usuarioLogin['email']);
                define('USUARIO_ROL', $usuarioLogin['perfil_id']);
                
                if ($usuarioLogin['validate_password']) {
                    return redirect()->route('cambio-contrasena');
                }
                if ($usuarioLogin['eliminado'] || !$usuarioLogin['estado']) {
                    return redirect()->route('sesion-finalizada');
                }
            } else {
                return redirect()->route('sesion-finalizada');
            }
        } else {
            return redirect()->route('login');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
