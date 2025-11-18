<?php

namespace App\Controllers;
use App\Models\Musuario;

class Usuario extends BaseController
{
    
    //Muestra la pagina con el formulario para inicar sesión
    public function vw_login(){
        echo view('admin/vw_login');
    }

    //Recibe el usuario y contraseña para validar el inicio de sesión
    public function fn_login(){
        $muser=new Musuario();
        $vUsuario = $this->request->getPost('usuario');
        $vClave   = $this->request->getPost('clave');

        $datos["usuario"]=$vUsuario;
        $datos["clave"]=$vClave;
        
        $rowsUser=$muser->m_login($datos);

        $ss=session();
        $resultado['row'] = $rowsUser;
        if (isset($rowsUser[0])){
            $ss->logueado=true;
            $ss->usuario=$rowsUser[0];
            $resultado['msg'] = "Accediste";
        }
        else{
            $ss->logueado=false;
            $resultado['msg'] = "No Accediste1";

        }
        return $this->response->setJSON($resultado);
    }

    public function vw_cuentas()
    {
        $ss=session();
        if ($ss->logueado==true){
            $cabecera['page_title'] ="Usuarios" ;
            $menu['menu_padre']="usuarios";
            echo view('vw_head',$cabecera);
            echo view('vw_nav',$menu);
            echo view('vw_sidebar');
            echo view('usuarios/vw_panel_usuarios');
            echo view('vw_footer');
        }
        else{
            header("Location: ".base_url("/usuario/login"));
            exit();
        }
    
    }
    
    //ruta para cerrar sesión
    public function fn_cerrarsesion(){
        $ss=session();
        $ss->logueado=false;
        header("Location: ".base_url("/usuario/login"));
        exit();
    }
}