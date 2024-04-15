<?php

namespace Controllers;

use Model\Categoria;
use MVC\Router;


class CategoriaController
{
  protected static $campos = ['cat_id', 'cat_nombre', 'cat_descripcion'];
  protected static $column_id = 'cat_id';
  protected static $column_search = 'cat_nombre';
  public static function index(Router $router, $alertas = [])
  {
    $categorias = Categoria::all();
    $router->render('categorias/index', ['categorias' => $categorias, 'alertas' => $alertas]);
  }

  public static function crear(Router $router)
  {
    $router->render('categorias/cat_crear');
  }
}
