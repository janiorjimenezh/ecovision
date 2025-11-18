<?php

namespace App\Models;

use CodeIgniter\Model;

class NivelContaminacionModel extends Model
{
    protected $table            = 'tb_niveles_contaminacion';
    protected $primaryKey       = 'niv_id';
    //protected $useAutoIncrement = true;

    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;

    protected $allowedFields    = [
        'niv_nombre',
        'niv_descripcion'
    ];

    // Validaciones opcionales
    protected $validationRules = [
        'niv_nombre'       => 'required|max_length[50]',
        'niv_descripcion'  => 'permit_empty|max_length[255]'
    ];

    protected $validationMessages = [];
    protected $skipValidation     = false;
}
