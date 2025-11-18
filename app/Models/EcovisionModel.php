<?php

namespace App\Models;

use CodeIgniter\Model;

class EcovisionModel extends Model
{
    protected $DBGroup          = 'cn_ecovision';
    protected $table            = 'vw_mapa_calor';
    protected $primaryKey       = 'rep_id';
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $useTimestamps    = false;

    // Método para obtener todos los puntos del mapa
    public function obtenerPuntosMapa()
    {
        return $this->select('rep_id, rep_titulo, rep_latitud, rep_longitud, tipo_contaminacion, nivel_contaminacion, rep_estado')
                    ->where('rep_latitud IS NOT NULL')
                    ->where('rep_longitud IS NOT NULL')
                    ->findAll();
    }
}
