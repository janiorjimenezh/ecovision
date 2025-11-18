<?php

namespace App\Models;

use CodeIgniter\Model;

class TipoContaminacionModel extends Model
{
    protected $table            = 'tb_tipos_contaminacion';
    protected $primaryKey       = 'tip_id';
    

    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;

    protected $allowedFields    = [
        'tip_nombre',
        'tip_descripcion'
    ];

    // Opcional: reglas de validación
    protected $validationRules = [
        'tip_nombre' => 'required|max_length[100]',
        'tip_descripcion' => 'permit_empty'
    ];

    protected $validationMessages = [];
    protected $skipValidation     = false;
}
