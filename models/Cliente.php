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

  public $cli_id;
  public $cli_nombre;
  public $cli_apellido;
  public $cli_cedula;
  public $cli_direccion;
  public $cli_correo;
  public $cli_telefono;

  public function __construct($args = [])
  {
    $this->cli_id = $args['cli_id'] ?? null;
    $this->cli_nombre = $args['cli_nombre'] ?? '';
    $this->cli_apellido = $args['cli_apellido'] ?? '';
    $this->cli_cedula = $args['cli_cedula'] ?? '';
    $this->cli_direccion = $args['cli_direccion'] ?? '';
    $this->cli_correo = $args['cli_correo'] ?? '';
    $this->cli_telefono = $args['cli_telefono'] ?? '';
  }

  public function validarCliente()
  {
    if (!$this->cli_nombre) {
      self::$alertas['error'][] = "El nombre es obligatorio";
    } else {
      if (!preg_match('/^[A-Za-z\s]+$/', $this->cli_nombre)) {
        self::$alertas['error'][] = "El nombre debe contener solo texto";
      }
    }

    if (!$this->cli_apellido) {
      self::$alertas['error'][] = "El apellido es obligatorio";
    } else {
      if (!preg_match('/^[A-Za-z\s]+$/', $this->cli_apellido)) {
        self::$alertas['error'][] = "El apellido debe contener solo texto";
      }
    }

    if (!$this->cli_cedula) {
      self::$alertas['error'][] = "La cedula es obligatorio";
    } else {
      if (!preg_match('/^[0-9]{2,10}+$/', $this->cli_cedula)) {
        self::$alertas['error'][] = "La cedula debe tener entre 5 y 10 NUMEROS";
      }
    }

    if (!$this->cli_telefono) {
      self::$alertas['error'][] = "El telefono es obligatorio";
    } else {
      if (!preg_match('/^\d{10}$/', $this->cli_telefono)) {
        self::$alertas['error'][] = "el telefono debe tener 10 digitos (Numeros)";
      } else if (!preg_match('/^[0-9]+$/', $this->cli_telefono)) {
      }
    }

    if (!$this->cli_correo) {
      self::$alertas['error'][] = "El correo es obligatorio";
    } else {
      if (!preg_match('/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $this->cli_correo)) {
        self::$alertas['error'][] = "Ingrese un correo valido";
      }
    }

    if (!$this->cli_direccion) {
      self::$alertas['error'][] = "La direccion es obligatorio";
    } else {
      if (!preg_match('/^[a-zA-Z0-9#\-\s]+$/', $this->cli_direccion)) {
        self::$alertas['error'][] = "Ingrese una direccion valido";
      }
    }

    return self::$alertas;
  }

  public function existeCliente()
  {
    $consulta = "SELECT * FROM " . self::$tabla . " WHERE cli_cedula = '" . $this->cli_cedula . "' LIMIT 1";

    $resultado = self::$db->prepare($consulta);
    $resultado->execute();

    if ($resultado->rowCount() > 0) {
      self::$alertas['error'][] = "El cliente ya esta registrado";
    }
    return $resultado;
  }

  public function clienteEncontrado($id)
  {
    $consulta = "SELECT * FROM " . self::$tabla . " WHERE cli_id = '" . $id . "' LIMIT 1";
    $resultado = self::$db->prepare($consulta);
    $resultado->execute();

    if ($resultado->rowCount() == 0) {
      self::$alertas['error'][] = "No se pudo actualizar el cliente";
    }

    return self::$alertas;
  }
}
