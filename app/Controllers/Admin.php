<?php

namespace App\Controllers;

class Admin extends BaseController
{
   //Página principal del panel de administración
    public function vw_index()
    {
        validar_sesion();
        $cabecera['page_title'] ="Mis Rositas" ;
        $menu['menu_inicio']="menu_activo";
        echo view('vw_head',$cabecera);
        echo view('vw_nav',$menu);
        echo view('vw_sidebar');
        echo view('vw_footer');
        
    }

}
