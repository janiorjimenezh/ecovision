<?php

namespace App\Controllers;

use App\Models\EcovisionModel;
use App\Models\ReporteModel;
use CodeIgniter\Controller;
use App\Models\NivelContaminacionModel;
use App\Models\TipoContaminacionModel;


class Reporte extends Controller
{
    public function vw_mapa()
    {
        validar_sesion();
        $cabecera['page_title'] ="Mapa de Contaminación" ;
        $menu['menu_padre']="mapa";
        

        $modelo = new ReporteModel();

        $ModelTipoContaminacion = new TipoContaminacionModel();
        $ModelNivelContaminacion = new NivelContaminacionModel();
        // Obtener todos los registros
        $data = [
            'reportes' => $modelo->obtenerReportes(),
            'conteo' => $modelo->contarPorEstado(),
            'tipocontamina' => $ModelTipoContaminacion->findAll(),
            'nivelcontamina' => $ModelNivelContaminacion->findAll()
        ];
        echo view('vw_head',$cabecera);
        echo view('vw_nav');
        echo view('vw_sidebar',$menu);
        echo view('reporte/vw_mapa', $data);
        echo view('vw_footer');
    }

    public function filtrar($tipo)
    {
        $modelo = new ReporteModel();
        return $this->response->setJSON($modelo->obtenerReportes($tipo));
    }

    public function detalle($id)
    {
        $modelo = new ReporteModel();
        $RowsReporte=$modelo->obtenerReportes($id);
        $RowReporte=null;
        if (count($RowsReporte)>0) $RowReporte=$RowsReporte[0];
        return $this->response->setJSON($RowReporte);
    }

    public function guardar()
    {
        $modelo = new ReporteModel();
        $imagen = $this->request->getFile('rep_imagen');
        $nombreImagen = null;

        if ($imagen && $imagen->isValid()) {
            $nombreImagen = $imagen->getRandomName();
            $imagen->move(FCPATH . 'uploads', $nombreImagen);
        }

        $modelo->insert([
            'rep_titulo' => $this->request->getPost('rep_titulo'),
            'rep_descripcion' => $this->request->getPost('rep_descripcion'),
            'tip_id' => $this->request->getPost('rep_tipo'),
            'niv_id' => $this->request->getPost('rep_nivel'),
            'rep_latitud' => $this->request->getPost('rep_latitud'),
            'rep_longitud' => $this->request->getPost('rep_longitud'),
            'rep_imagen' => "uploads/".$nombreImagen,
            'rep_estado' => 'pendiente',
            'rep_fecha' => date('Y-m-d'),
            'usu_id' => session()->usuario->codusuario
            
        ]);

        return redirect()->to('/mapa');
    }

   


    // Opción API para consumir desde JS si se requiere en JSON
    public function api()
    {
        $modelo = new EcovisionModel();
        $puntos = $modelo->obtenerPuntosMapa();
        return $this->response->setJSON($puntos);
    }
}
