<?php

namespace Model;

class Producto extends ActiveRecord
{
  // ? Base de datos 
  protected static $tabla = "productos";
  protected static $columnasDB = ['prod_id', 'prod_nombre', 'prod_descripcion', 'prod_precio_unitario', 'prod_existencias', 'prod_cat_id'];

  public $prod_id;
  public $prod_nombre;
  public $prod_descripcion;
  public $prod_precio_unitario;
  public $prod_existencias;
  public $prod_cat_id;

  public function __construct($args = [])
  {
    $this->prod_id = $args['prod_id'] ?? null;
    $this->prod_nombre = $args['prod_nombre'] ?? '';
    $this->prod_descripcion = $args['prod_descripcion'] ?? '';
    $this->prod_precio_unitario = $args['prod_precio_unitario'] ?? '';
    $this->prod_existencias = $args['prod_existencias'] ?? '';
    $this->prod_cat_id = $args['prod_cat_id'] ?? '';
  }

  public function validarBusqueda($search)
  {
    if (empty($search)) {
      self::$alertas['error'][] = "ingresar un nombre valido";
    }

    return self::$alertas;
  }
}
