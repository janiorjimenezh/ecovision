<?php

namespace App\Controllers;

class Pagina extends BaseController
{
    public function vw_index()
    {
        $ss=session();
        $ss->logueado=false;
        $ss->nombre="Maricarmen";
        $cabecera['title'] = 'Mis Rositas';
        echo view('cabecera', $cabecera);
        $menu['menu_inicio']="menu_activo";
        $menu['menu_productos']="";
        $menu['menu_galeria']="";
        $menu['menu_contacto']="";
        echo view('menu',$menu);
        echo view('index');
        echo view('pie');
    }
    
    public function vw_productos(){
        $cabecera['title'] = 'Mis Rositas';
        echo view('cabecera', $cabecera);
        $menu['menu_inicio']="";
        $menu['menu_productos']="menu_activo";
        $menu['menu_galeria']="";
        $menu['menu_contacto']="";
        echo view('menu',$menu);
        echo view('productos');
        echo view('pie');
    }
    
}
