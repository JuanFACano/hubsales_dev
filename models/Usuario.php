<?php

namespace Model;

use \PDO;

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

  // ? Mensaje de Validacion para creacion de usuario
  public function validarNuevoUsuario()
  {
    if (!$this->nombre) {
      self::$alertas['error'][] = "El nombre es obligatorio";
    }
    if (!$this->apellido) {
      self::$alertas['error'][] = "El apellido es obligatorio";
    }
    if (!$this->correo) {
      self::$alertas['error'][] = "El correo es obligatorio";
    }
    if (!$this->contrasenia) {
      self::$alertas['error'][] = "La contraseña es obligatoria";
    } else if (strlen($this->contrasenia) < 6) {
      self::$alertas['error'][] = "Contraseña debe tener al menos 6 caracteres";
    }

    if (!$this->rol) {
      self::$alertas['error'][] = "Seleccione un rol";
    }


    return self::$alertas;
  }

  // ? Revision de usuario existente
  public function existeUsuario()
  {
    $consulta = "SELECT * FROM " . self::$tabla . " WHERE user_correo = '" . $this->correo . "' LIMIT 1";
    $resultado = self::$db->prepare($consulta);
    $resultado->execute();

    if ($resultado->rowCount() > 0) {
      self::$alertas['error'][] = "El usuario ya esta registrado";
    }
    return $resultado;
  }

  public function hashPassword()
  {
    $this->contrasenia = password_hash($this->contrasenia, PASSWORD_BCRYPT);
  }
}
