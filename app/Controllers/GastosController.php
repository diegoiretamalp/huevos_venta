<?php

namespace App\Controllers;

class GastosController extends BaseController
{
    public function NuevoGastoRuta()
    {
        $post = $this->request->getPost();
        if(!empty($post)){
            $nombre = !empty($post['nombre'])? $post['nombre'] : '';
            $ruta_id = !empty($post['ruta_id'])? $post['ruta_id'] : '';
            $monto = !empty($post['monto'])? $post['monto'] : '';
            if(!empty($nombre) && !empty($ruta_id) && !empty($monto)){
                $new_gasto = [
                    'nombre' => $nombre,
                    'monto' => $monto,
                    'ruta_id' => $ruta_id,
                    'estado' => true,
                    'created_at' => getTimestamp()
                ];
                $gasto = InsertRowTable('gastos', $new_gasto);
                if($gasto > 0){
                    $rsp = [
                        'tipo' => 'success',
                        'msg' => 'Gasto registrado con éxito.'
                    ];
                }else{
                    $rsp = [
                        'tipo' => 'error',
                        'msg' => 'Gasto no registrado.'
                    ];
                }
            }else{
                $rsp = [
                    'tipo' => 'warning',
                    'msg' => '1 o más campos son requeridos, completalos para continuar.'
                ];    
            }
        }else{
            $rsp = [
                'tipo' => 'error',
                'msg' => 'Datos no recibidos por el servidor.'
            ];
        }
        return json_encode($rsp);
    }
}
