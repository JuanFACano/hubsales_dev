<?php

namespace Model;

class Cliente extends ActiveRecord
{
  // Base de Datos 
  protected static $tabla = 'clientes';
  protected static $columnasDB = [
    'cli_id',
    'cli_nombre',
    'cli_apellido',
    'cli_cedula',
    'cli_direccion',
    'cli_correo',
    'cli_telefono'
  ];
}
