<?php

namespace Model;

class Usuario extends ActiveRecord
{
  // Base de Datos 
  protected static $tabla = 'usuarios';
  protected static $columnasDB = [
    'user_id',
    'user_nombre',
    'user_apellido',
    'user_rol',
    'user_avatar',
    'user_correo',
    'user_contrasenia'
  ];

  public $id;
  public $nombre;
  public $apellido;
  public $rol;
  public $avatar;
  public $correo;
  public $contrasenia;

  public function __construct($args = [])
  {
    $this->id = $args['id'] ?? null;
    $this->nombre = $args['nombre'] ?? '';
    $this->apellido = $args['apellido'] ?? '';
    $this->rol = $args['rol'] ?? null;
    $this->avatar = $args['avatar'] ?? '';
    $this->correo = $args['correo'] ?? '';
    $this->contrasenia = $args['contrasenia'] ?? '';
  }
}
