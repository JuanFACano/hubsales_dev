<?php

namespace Controllers;

use Model\Producto;
use MVC\Router;



class ProductoController
{
  protected static $campos = ['prod_nombre', 'prod_precio_unitario', 'prod_existencias', 'cat_nombre', 'prod_descripcion'];
  protected static $tablas_join = ['productos', 'categorias_productos'];
  protected static  $columnas = ['prod_cat_id', 'cat_id'];


  public static function index(Router $router)
  {
    $productosJoin = Producto::queryBuilderAll(self::$campos, self::$tablas_join, self::$columnas);

    $router->render('productos/producto', $productosJoin);
  }
}
