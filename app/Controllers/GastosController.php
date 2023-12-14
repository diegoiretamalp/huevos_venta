<?php

namespace App\Controllers;

class GastosController extends BaseController
{
    public function NuevoGastoRuta()
    {
        $post = $this->request->getPost();
        if (!empty($post)) {
            $nombre = !empty($post['nombre']) ? $post['nombre'] : '';
            $ruta_id = !empty($post['ruta_id']) ? $post['ruta_id'] : '';
            $monto = !empty($post['monto']) ? $post['monto'] : '';
            if (!empty($nombre) && !empty($ruta_id) && !empty($monto)) {
                $new_gasto = [
                    'nombre' => $nombre,
                    'monto' => $monto,
                    'ruta_id' => $ruta_id,
                    'estado' => true,
                    'created_at' => getTimestamp()
                ];
                $gasto = InsertRowTable('gastos', $new_gasto);
                if ($gasto > 0) {
                    $rsp = [
                        'tipo' => 'success',
                        'msg' => 'Gasto registrado con éxito.'
                    ];
                } else {
                    $rsp = [
                        'tipo' => 'error',
                        'msg' => 'Gasto no registrado.'
                    ];
                }
            } else {
                $rsp = [
                    'tipo' => 'warning',
                    'msg' => '1 o más campos son requeridos, completalos para continuar.'
                ];
            }
        } else {
            $rsp = [
                'tipo' => 'error',
                'msg' => 'Datos no recibidos por el servidor.'
            ];
        }
        return json_encode($rsp);
    }

    public function EliminarGasto($gasto_id)
    {
        $rsp = [];

        if (is_numeric($gasto_id)) {
            $gasto = GetObjectRowByWhere('gastos', ['id' => $gasto_id, 'estado' => true, 'eliminado' => false]);
            if (!empty($gasto)) {

                $rsp = UpdateRowTableByWhere('gastos', ['eliminado' => true, 'estado' => false, 'deleted_at' => getTimestamp()], ['id' => $gasto_id]);
                if($rsp > 0){
                    $rsp = [
                        'tipo' => 'success',
                        'title' => 'Gestión de Gastos',
                        'msg' => 'Gasto eliminado con éxito!',
                        'data' => []
                    ];
                    http_response_code(200); // Código de estado HTTP: 200 OK
                }else{
                    $rsp = [
                        'tipo' => 'error',
                        'title' => 'Gestión de Gastos',
                        'msg' => 'Gasto no eliminado, actualiza la página e intenta nuevamente.',
                        'data' => []
                    ];
                    http_response_code(500); // Código de estado HTTP: 200 OK
                }
            } else {
                $rsp = [
                    'tipo' => 'error',
                    'title' => 'Gestión de Gastos',
                    'msg' => 'Gastos no existe o fue eliminado',
                    'data' => []
                ];
                http_response_code(404); // Código de estado HTTP: 404 Not Found
            }
        } else {
            $rsp = [
                'tipo' => 'error',
                'title' => 'Gestión de Gastos',
                'msg' => 'Datos no recibidos por el servidor',
                'data' => []
            ];
            http_response_code(400); // Código de estado HTTP: 400 Bad Request
        }

        header('Content-Type: application/json');
        echo json_encode($rsp);
        exit;
    }
}
