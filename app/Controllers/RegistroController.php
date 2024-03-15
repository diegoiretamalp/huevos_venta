<?php

namespace App\Controllers;

class RegistroController extends BaseController
{
    public function __construct()
    {
        $this->session = session();
        $this->Usuarios_model = model('App\Models\Usuarios_model');
        $this->Empresas_model = model('App\Models\Empresas_model');
    }
    public function index()
    {
        $post = $this->request->getPost();
        if (!empty($post)) {
            
            if ($validate = $this->validateField($post)) {
                $this->session->setflashdata("error_title", "Error de Validación");
                $this->session->setflashdata("error", "Se encontraron los siguientes errores: " . implode(", ", $validate));
                $this->session->setflashdata("errores", $post);
                return redirect('registro');
            } else {
                $new_empresa = [
                    'rut' => !empty($post['rut']) ? str_replace('.', '', $post['rut']): NULL,
                    'email' => !empty($post['email']) ? $post['email']: NULL,
                    'razon_social' => !empty($post['razon_social']) ? $post['razon_social']: NULL,
                    'estado' => true,
                    'deleted' => false,
                    'created_at' => getTimestamp(),
                ];
                

            }
        }
        $data = [
            'title' => 'Registro de Empresa',
            'main_view' => 'login/registro_view',
            'js_content' => [
                '0' => 'layout/js/generalJS',
                '1' => 'login/js/validate_rut',
                '2' => 'login/js/RegistroJS'
            ]
        ];
        return view('layout/layout_nologin2_view', $data);
    }
    public function NuevoSector()
    {
        $post = $this->request->getPost();

        if (!empty($post)) {
            //pre_die($post);
            if ($validate = $this->validateField($post)) {
                $this->session->setflashdata("error_title", "Error de Validación");
                $this->session->setflashdata("error", "Se encontraron los siguientes errores: " . implode(", ", $validate));
                $this->session->setflashdata("errores", $post);
                return redirect('sectores/nuevo');
            } else {

                $sector_array = [
                    'nombre' => !empty($post['nombre']) ? $post['nombre'] : NULL,
                    'comuna_id' => !empty($post['comuna_id']) ? $post['comuna_id'] : NULL,
                    'created_at' => getTimestamp()
                ];

                $id_sector = $this->Sectores_model->insertSector($sector_array);
                if ($id_sector > 0) {
                    $this->session->setflashdata("success_title", "Mantenedor de Sectores");
                    $this->session->setflashdata("success", "Se ha creado el sector con exito!");
                    return redirect('sectores/listado');
                } else {
                    $this->session->setflashdata("error_title", "Error de Validación");
                    $this->session->setflashdata("error", "Se encontraron los siguientes errores: " . implode(", ", $validate));
                    $this->session->setflashdata("errores", $post);
                    return redirect('sectores/nuevo');
                }
            }
        }


        $comunas = GetObjectByWhere('comunas', ['estado' => true]);

        $data = [
            'title' => 'Nuevo Sector',
            'main_view' => 'sectores/sectores_new_view',
            'comunas' => !empty($comunas) ? $comunas : [],
            'js_content' => [
                '0' => 'layout/js/generalJS',
                '1' => 'sectores/js/sectoresJS'
            ]
        ];
        return view('layout/layout_main_view', $data);
    }
    public function VerSector($id)
    {
        $post = $this->request->getPost();
        $where_sectores = [
            'estado' => true,
            'eliminado' => false,
        ];
        $sectores = $this->Sectores_model->getSector($where_sectores);

        $data = [
            'title' => 'Ver Sector',
            'main_view' => 'sector/sectores_ver_view',
            'sectores' => !empty($sectores) ? $sectores : [],
            'js_content' => [
                '0' => 'layout/js/generalJS',
                '1' => 'sectores/js/RutasJS'
            ]
        ];
        return view('layout/layout_main_view', $data);
    }
    public function EditarSector($id)
    {



        $post = $this->request->getPost();

        if (!empty($post)) {
            if ($validate = $this->validateField($post)) {
                $this->session->setflashdata("error_title", "Error de Validación");
                $this->session->setflashdata("error", "Se encontraron los siguientes errores: " . implode(", ", $validate));
                $this->session->setflashdata("errores", $post);
                return redirect()->route('sectores/editar/' . $id);
            } else {
                //  pre_die($post);
                $array_update = [
                    'nombre' => !empty($post['nombre']) ? $post['nombre'] : NULL,
                    'comuna_id' => !empty($post['comuna_id']) ? $post['comuna_id'] : NULL,
                    'updated_at' => gettimestamp()
                ];

                //pre_die($array_update);
                $rsp = $this->Sectores_model->updateSector($array_update, $id);
                if ($rsp) {
                    $this->session->setflashdata("success_title", "Mantenedor de Sectores");
                    $this->session->setflashdata("success", "Se ha modificado el sector con exito!");
                    return redirect('sectores/listado');
                } else {
                    $this->session->setflashdata("error_title", "Error de validación");
                    $this->session->setflashdata("error", "No se ha modificado el sector");
                    $this->session->setflashdata("errores", $post);
                    return redirect('sectores/editar/' . $id);
                }
            }
        }

        $sector = $this->Sectores_model->getSector($id);
        $comunas = GetObjectByWhere('comunas', ['estado' => true]);
        // pre($sector);
        // pre_die($comunas);

        $data = [
            'title' => 'Editar Sector',
            'action' => base_url('sectores/editar/' . $id),
            'comunas' => !empty($comunas) ? $comunas : [],
            'sector' => !empty($sector) ? $sector : [],
            'main_view' => 'sectores/sectores_edit_view',
            'js_content' => [
                '0' => 'layout/js/generalJS',
                '1' => 'sectores/js/SectoresJS'
            ]
        ];
        return view('layout/layout_main_view', $data);
    }
    public function EliminarSector()
    {
        $post = $this->request->getPost();

        if (!empty($post)) {
            $id = $post['sector_id'];
            $where = [
                'id' => $id,
                'eliminado' => false,
            ];

            $arr_data = [
                'eliminado' => true,
                'deleted_at' => getTimestamp(),
            ];

            $sector = $this->Sectores_model->getSectorWhere($where);

            if (empty($sector)) {
                echo false;
            } else {
                $deleted = $this->Sectores_model->deleteSector($arr_data, $id);
                if ($deleted) {
                    echo true;
                } else {
                    echo false;
                }
            }
        } else {
            echo false;
        }
    }

    public function ObtenerSector()
    {
        $post = $this->request->getPost();
        if (!empty($post)) {
            $sector = $this->Sectores_model->getSector($post['sector_id']);
            if (!empty($sector)) {
                $rsp = [
                    'tipo' => 'success',
                    'msg' => 'Datos cargados con éxito.',
                    'data' => !empty($sector) ? $sector : []
                ];
            } else {
                $rsp = [
                    'tipo' => 'error',
                    'msg' => 'Sector no existe o fue eliminado.'
                ];
            }
        } else {
            $rsp = [
                'tipo' => 'error',
                'msg' => 'Datos no Recibidos por el Servidor'
            ];
        }
        return json_encode($rsp);
    }

    protected function validateField($data)
    {
        $error = [];
        $error_flag = false;
        if (!validateRut(trim($data['rut']))) {
            $error_flag = true;
            $error['rut'] = 'Rut Inválido';
        } else {
            $valRut = $this->Empresas_model->getEmpresaWhere(['rut' =>  str_replace('.', '', $data['rut']), 'deleted' => false]);
            if (!empty($valRut)) {
                $error_flag = true;
                $error['rut'] = 'Rut Ingresado ya está registrado en nuestra Base de Datos';
            }
        }

        if (validateText(trim($data['razon_social']))) {
            $error_flag = true;
            $error['razon_social'] = 'Razón Social';
        }
        if (validateEmail(trim($data['email']))) {
            $error_flag = true;
            $error['email'] = 'Correo electrónico';
        } else {
            $valUsername = $this->Usuarios_model->getUsuarioWhere(['email' => strtolower($data['email']), 'eliminado' => false]);
            if (!empty($valUsername)) {
                $error_flag = true;
                $error['email'] = 'Email Ingresado ya está registrado en nuestra Base de Datos';
            }
        }
        if (validatePassword($data['password'])) {
            $error_flag = true;
            $error['password'] = 'Contraseña';
        }
        if (validatePassword($data['password_confirm'])) {
            $error_flag = true;
            $error['password_confirm'] = 'Confirmar Contraseña';
        }
        if ($data['password'] != $data['password_confirm']) {
            $error_flag = true;
            $error['password'] = 'Contraseñas No coinciden ';
        }
        if ($error_flag) {
            return $error;
        } else {
            return false;
        }
    }
}
