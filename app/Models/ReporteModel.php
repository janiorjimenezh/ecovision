<?php

namespace App\Models;

use CodeIgniter\Model;

class ReporteModel extends Model
{
    protected $table = 'tb_reportes';
    protected $primaryKey = 'rep_id';
    protected $allowedFields = [
        'rep_titulo',
        'rep_descripcion',
        'rep_latitud',
        'rep_longitud',
        'rep_direccion',
        'rep_imagen',
        'rep_estado',
        'rep_fecha',
        'usu_id',
        'tip_id',
        'niv_id'
    ];

    
    // Obtener reportes con joins y filtros dinámicos
    public function obtenerReportes($filtros = [])
    {
        $builder = $this->db->table($this->table . ' r');
        $builder->select([
            'r.rep_id AS codreporte',
            'r.rep_titulo AS titulo',
            'r.rep_descripcion AS descripcion',
            'r.rep_imagen AS imagen',
            'r.rep_fecha AS fecha',
            'r.rep_latitud AS latitud',
            'r.rep_longitud AS longitud',
            'r.rep_direccion AS direccion',
            'r.rep_estado AS estado',
            't.tip_nombre AS tipon',
            'n.niv_nombre AS nivel',
            'u.usu_nombre AS nombre_usuario',
            'u.usu_apellido AS apellido_usuario',
            'u.usu_email AS email_usuario'
        ]);

        // Joins
        $builder->join('tb_tipos_contaminacion t', 't.tip_id = r.tip_id', 'left');
        $builder->join('tb_niveles_contaminacion n', 'n.niv_id = r.niv_id', 'left');
        $builder->join('tb_usuarios u', 'u.usu_id = r.usu_id', 'left');

        // Filtros dinámicos
        if (!empty($filtros['tipo'])) {
            $builder->where('t.tip_id', $filtros['tipo']);
        }
        if (!empty($filtros['id'])) {
            $builder->where('r.rep_id', $filtros['id']);
        }

        if (!empty($filtros['usuario'])) {
            $builder->where('r.usu_id', $filtros['usuario']);
        }

        if (!empty($filtros['nivel'])) {
            $builder->where('n.niv_id', $filtros['nivel']);
        }

        if (!empty($filtros['estado'])) {
            $builder->where('r.rep_estado', $filtros['estado']);
        }

        // Si deseas filtrar por rango de fechas
        if (!empty($filtros['fecha_inicio']) && !empty($filtros['fecha_fin'])) {
            $builder->where('r.rep_fecha >=', $filtros['fecha_inicio']);
            $builder->where('r.rep_fecha <=', $filtros['fecha_fin']);
        }

        // Ordenar por fecha más reciente
        $builder->orderBy('r.rep_fecha', 'DESC');

        return $builder->get()->getResultArray();
    }

    public function contarPorEstado()
    {
        return $this->select('rep_estado, COUNT(*) as total')
                    ->groupBy('rep_estado')
                    ->findAll();
    }


}
