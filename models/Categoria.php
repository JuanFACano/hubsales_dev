<?php

namespace Model;

class Categoria extends ActiveRecord
{
  // ? Base de datos 
  protected static $tabla = "categorias_productos";
  protected static $columnasDB = ['cat_id', 'cat_nombre', 'cat_descripcion'];
  protected static $campo_validate = "cat_nombre";

  public $cat_id;
  public $cat_nombre;
  public $cat_descripcion;

  public function __construct($args = [])
  {
    $this->cat_id = $args['cat_id'] ?? null;
    $this->cat_nombre = $args['cat_nombre'] ?? '';
    $this->cat_descripcion = $args['cat_descripcion'] ?? '';
  }

  public function validarCategoria()
  {
    if (!$this->cat_nombre) {
      self::$alertas['error'][] = "El nombre es obligatorio";
    } elseif (!preg_match('/^[a-zA-Z0-9ñÑ\s]+$/', $this->cat_nombre)) {
      self::$alertas['error'][] = "El nombre no no debe contener caracteres especiales";
    }

    if (!$this->cat_descripcion) {
      self::$alertas['error'][] = "La descripción es obligatoria";
    } elseif (!preg_match('/^[a-zA-Z0-9-ñÑ.,\s]+$/', $this->cat_descripcion)) {
      self::$alertas['error'][] = "La descripción no debe contener caracteres especiales";
    }

    return self::$alertas;
  }

  public function existeCategoria()
  {
    $consulta = "SELECT * FROM " . self::$tabla . " WHERE " . self::$campo_validate . " = '" . $this->cat_nombre . "' LIMIT 1";

    $resultado = self::$db->prepare($consulta);
    $resultado->execute();

    if ($resultado->rowCount() > 0) {
      self::$alertas['error'][] = "la Categoria ya esta registrada";
    }

    return $resultado;
  }

  public static function categoriaEncontrado($id)
  {
    $consulta = "SELECT * FROM " . self::$tabla . " WHERE cat_id = '" . $id . "' LIMIT 1";
    $resultado = self::$db->prepare($consulta);
    $resultado->execute();

    if ($resultado->rowCount() == 0) {
      self::$alertas['error'][] = "No se pudo actualizar la categoria";
    }

    return self::$alertas;
  }
}
