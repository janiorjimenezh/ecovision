<?php 
namespace App\Models;
use CodeIgniter\Model;

class Musuario extends Model
{
	protected $DBGroup 			= 'cn_ecovision';
	protected $table            = 'tbusers';
  protected $primaryKey       = 'usu_id ';
  protected $allowedFields    = [ 
    'usu_nombres',
    'usu_apellidos',
    'usu_email',
    'usu_password',
    'usu_tipo',
    'created_at'
  ];

  public function m_login($datos)
  {
    $sqlArray[]=$datos["usuario"];
    $sqlArray[]=$datos["clave"];

    $result = $this->db->query("SELECT 
              usu_id as codusuario,
              usu_apellido as apellidos,
              usu_nombre as nombres,
              usu_tipo as tipo,
              usu_email as email 
            FROM 
              tb_usuarios
            WHERE usu_email=? AND usu_password=?", $sqlArray);
    return $result->getResult();
  }
}

  