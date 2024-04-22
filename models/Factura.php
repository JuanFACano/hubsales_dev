<?php

namespace Model;

class Factura extends ActiveRecord
{
  // Base de Datos 
  protected static $tabla = 'facturas';
  protected static $columnasDB = [
    'fac_id',
    'fac_fecha',
    'fac_fecha_venc',
    'fac_cli_id',
    'fac_user_id',
  ];

  public $fac_id;
  public $fac_fecha;
  public $fac_fecha_venc;
  public $fac_cli_id;
  public $fac_user_id;


  public function __construct($args = [])
  {
    $this->fac_id = $args['fac_id'] ?? null;
    $this->fac_fecha = $args['fac_fecha'] ?? '';
    $this->fac_fecha_venc = $args['fac_fecha_venc'] ?? '';
    $this->fac_cli_id = $args['fac_cli_id'] ?? '';
    $this->fac_user_id = $args['fac_user_id'] ?? '';
  }

  public static function validarFactura()
  {
  }
}
