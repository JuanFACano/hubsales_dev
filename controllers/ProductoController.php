<?php

namespace Controllers;

use Model\Categoria;
use Model\Producto;
use MVC\Router;


class ProductoController
{
  protected static $campos = ['prod_id', 'prod_nombre', 'prod_precio_unitario', 'prod_existencias', 'cat_nombre', 'prod_descripcion', 'prod_sku'];
  protected static $column_id = 'prod_id';
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
    // ? Instanciar Producto
    $producto = new Producto($_POST);
    $alertas = [];
    $categorias = self::getCategorias();
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

      $producto->sincronizar($_POST);
      $alertas = $producto->validarProducto();

      if (empty($alertas)) {
        $resultado = $producto->existeProducto();

        if ($resultado->rowCount()) {
          $alertas = Producto::getAlertas();
        } else {
          $resultado = $producto->crear();
          if ($resultado) {
            header("Location: /productos");
          }
        }
      }
    }

    $router->render('productos/prod_crear', ["producto" => $producto, "alertas" => $alertas, "categorias" => $categorias]);
  }

  public static function editar(Router $router)
  {
    $id_get = $_GET['id'];
    $producto = new Producto($_POST);
    $alertas = [];
    $categorias = self::getCategorias();

    $campos = ['prod_id', 'prod_nombre', 'prod_precio_unitario', 'prod_existencias', 'prod_cat_id', 'cat_nombre', 'prod_descripcion', 'prod_sku'];
    $productoEdit = Producto::consultarSQLFind($campos, self::$tablas_join, self::$columnas, self::$column_id, $id_get)[0];

    if ($_SERVER['REQUEST_METHOD'] === "GET") {
      $producto->sincronizar($productoEdit);
      $alertas = $producto->productoEncontrado($id_get);
    } else {
      $producto->prod_id = $productoEdit->prod_id;

      if ($producto->prod_cat_id == '') {
        $producto->prod_cat_id = $productoEdit->prod_cat_id;
      }
      $producto->sanitizarAtributos();
      $alertas = $producto->validarProducto();

      if (empty($alertas)) {
        $producto->sanitizarDatos();
        $resultado = $producto->actualizar(self::$column_id);

        if ($resultado) {
          header("location: /productos");
        } else {
          $alertas['error'][] = "no se pudo actualizar";
          $alertas = $producto::getAlertas();
        }
      }
    }

    $router->render("productos/prod_edit", ["producto" =>  $producto, "alertas" => $alertas, "categorias" => $categorias]);
  }

  public static function search(Router $router)
  {
    $alertas = [];
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $searchDB = $_POST['search'];
      $search = normalizeStr($searchDB);

      $producto = new Producto;
      $alertas = $producto->validarBusqueda($search);

      if (empty($alertas)) {
        $productoSearch = Producto::consultarSQLFind(self::$campos, self::$tablas_join, self::$columnas, self::$column_search, $search, true);

        if (!empty($productoSearch)) {
          $router->render('productos/index', ["productos" => $productoSearch, "alertas" => $alertas]);
        } else {
          Producto::setAlerta('error', 'No se encontro ningún producto');
        }
      }

      $alertas = Producto::getAlertas();
      static::index($router, $alertas);
    }
  }

  public static function getCategorias()
  {
    $categorias = Categoria::all();
    return $categorias;
  }
}
