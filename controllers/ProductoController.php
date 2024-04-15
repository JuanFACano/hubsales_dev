<?php

namespace Controllers;

use Model\Producto;
use MVC\Router;



class ProductoController
{
  protected static $campos = ['prod_id', 'prod_nombre', 'prod_precio_unitario', 'prod_existencias', 'cat_nombre', 'prod_descripcion'];
  protected static $column_id = ['prod_id'];
  protected static $column_search = 'prod_nombre';
  protected static $tablas_join = ['productos', 'categorias_productos'];
  protected static  $columnas = ['prod_cat_id', 'cat_id'];


  public static function index(Router $router, $alertas = [])
  {
    $productosJoin = Producto::consultarSQLBuilderAll(self::$campos, self::$tablas_join, self::$columnas);
    $router->render('productos/index', ["productos" => $productosJoin, "alertas" => $alertas]);
  }

  public static function crear(Router $router)
  {
    $producto = new Producto($_POST);
    $alertas = [];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    }

    $router->render('productos/prod_crear');
  }

  public static function search(Router $router)
  {
    $alertas = [];
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $search = s($_POST['search']);
      $producto = new Producto;
      $alertas = $producto->validarBusqueda($search);

      if (empty($alertas)) {
        $productoSearch = Producto::consultarSQLFind(self::$campos, self::$tablas_join, self::$columnas, self::$column_search, $search, true);
        debuguear($productoSearch);

        if ($productoSearch) {
          debuguear("encontrado");
        } else {
          debuguear("No encontrado");
        }
      }

      $alertas = Producto::getAlertas();
      static::index($router, $alertas);
    }
  }
}
