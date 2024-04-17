<?php

namespace Model;

class Producto extends ActiveRecord
{
  // ? Base de datos 
  protected static $tabla = "productos";
  protected static $columnasDB = ['prod_id', 'prod_nombre', 'prod_descripcion', 'prod_precio_unitario', 'prod_existencias', 'prod_cat_id', 'prod_sku'];
  protected static $campo_validate = "prod_sku";

  public $prod_id;
  public $prod_nombre;
  public $prod_descripcion;
  public $prod_precio_unitario;
  public $prod_existencias;
  public $prod_cat_id;
  public $prod_sku;


  public function __construct($args = [])
  {
    $this->prod_id = $args['prod_id'] ?? null;
    $this->prod_nombre = $args['prod_nombre'] ?? '';
    $this->prod_descripcion = $args['prod_descripcion'] ?? '';
    $this->prod_precio_unitario = $args['prod_precio_unitario'] ?? '';
    $this->prod_existencias = $args['prod_existencias'] ?? '';
    $this->prod_cat_id = $args['prod_cat_id'] ?? '';
    $this->prod_sku = $args['prod_sku'] ?? '';
  }

  public function validarProducto()
  {
    if (!$this->prod_nombre) {
      self::$alertas['error'][] = "El nombre es obligatorio";
    } else {
      if (!preg_match('/^[A-Za-z0-9ñÑ\p{L}\s]+$/', $this->prod_nombre)) {
        self::$alertas['error'][] = "El nombre no debe contener caracteres especiales";
      }
    }

    if (!$this->prod_sku) {
      self::$alertas['error'][] = "El codigo de producto es obligatorio";
    } elseif (!preg_match('/^[A-Z0-9]{15,}$/', $this->prod_sku)) {
      self::$alertas['error'][] = "El codigo debe tener el siguiente formato '12012023CE12345'";
    }

    if (!$this->prod_descripcion) {
      self::$alertas['error'][] = "La descripcion es obligatorio";
    } else {
      if (!preg_match('/^[A-Za-z0-9ñÑ,\p{L}\s]+$/', $this->prod_descripcion)) {
        self::$alertas['error'][] = "La descripcion no puede contener caracteres especiales";
      }
    }

    if (!$this->prod_cat_id) {
      self::$alertas['error'][] = "Escoga la categoria del producto";
    } else {
      if (!preg_match('/^\d+$/', $this->prod_cat_id)) {
        self::$alertas['error'][] = "Escoga una de las categorias";
      }
    }

    if (!$this->prod_precio_unitario) {
      self::$alertas['error'][] = "El precio es obligatorio";
    } else {
      if (!preg_match('/^\d+$/', $this->prod_precio_unitario)) {
        self::$alertas['error'][] = "Ingrese un valor correcto para el precio";
      }
    }

    if (!$this->prod_existencias) {
      self::$alertas['error'][] = "El número de existencias es obligatorio";
    } else {
      if (!preg_match('/^\d+$/', $this->prod_existencias)) {
        self::$alertas['error'][] = "Ingrese un valor correcto para las existencias";
      }
    }

    return self::$alertas;
  }

  public function existeProducto()
  {
    $consulta = "SELECT * FROM " . self::$tabla . " WHERE " . self::$campo_validate . " = '" . $this->prod_sku . "' LIMIT 1";
    $resultado = self::$db->prepare($consulta);
    $resultado->execute();

    if ($resultado->rowCount() > 0) {
      self::$alertas['error'][] = "El producto ya esta registrado";
    }

    return $resultado;
  }

  public function productoEncontrado($id)
  {
    $consulta = "SELECT * FROM " . self::$tabla . " WHERE prod_id = '" . $id . "' LIMIT 1";
    $resultado = self::$db->prepare($consulta);
    $resultado->execute();

    if ($resultado->rowCount() == 0) {
      self::$alertas['error'][] = "No se pudo actualizar el producto";
    }

    return self::$alertas;
  }

  public function validarBusqueda($search)
  {
    if (empty($search)) {
      self::$alertas['error'][] = "ingresar un nombre valido";
    }

    return self::$alertas;
  }
}
