<?php

namespace Model;

class Categoria extends ActiveRecord
{
  // ? Base de datos 
  protected static $tabla = "categorias_productos";
  protected static $columnasDB = ['cat_id', 'cat_nombre', 'cat_descripcion'];

  public $cat_id;
  public $cat_nombre;
  public $cat_descripcion;

  public function __construct($args = [])
  {
    $this->cat_id = $args['cat_id'] ?? null;
    $this->cat_nombre = $args['cat_nombre'] ?? '';
    $this->cat_descripcion = $args['cat_descripcion'] ?? '';
  }
}
