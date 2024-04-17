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
    $categoria = new Categoria($_POST);
    $alertas = [];


    if ($_SERVER['REQUEST_METHOD'] === "POST") {
      $categoria->sincronizar($_POST);
      $alertas = $categoria->validarCategoria();

      if (empty($alertas)) {
        $resultado = $categoria->existeCategoria();

        if ($resultado->rowCount()) {
          $alertas = Categoria::getAlertas();
        } else {
          $resultado = $categoria->crear();

          if ($resultado) {
            header('Location: /categorias');
          }
        }
      }
    }

    $router->render('categorias/cat_crear', ["categoria" => $categoria, "alertas" => $alertas]);
  }

  public static function editar(Router $router)
  {
    $id_get = $_GET['id'];
    $categoria = new Categoria();
    $alertas = [];

    $categoriaEdit = Categoria::find($id_get, self::$column_id);

    if ($_SERVER['REQUEST_METHOD'] === "GET") {
      $categoria->sincronizar($categoriaEdit);
      $alertas = $categoria->categoriaEncontrado($id_get);
    } else {
      $categoria->sincronizar($_POST);
      $categoria->cat_id = $categoriaEdit->cat_id;

      if ($categoria->cat_nombre === '') {
        $categoria->cat_nombre = $categoriaEdit->cat_nombre;
      }

      if ($categoria->cat_descripcion === '') {
        $categoria->cat_descripcion = $categoriaEdit->cat_descripcion;
      }

      $categoria->sanitizarAtributos();
      $alertas = $categoria->validarCategoria();

      if (empty($alertas)) {
        $categoria->sanitizarDatos();
        $resultado = $categoria->actualizar(self::$column_id);

        if ($resultado) {
          header("location: /categorias");
        } else {
          $alertas['error'][] = "No se pudo actualizar";
          $alertas = $categoria::getAlertas();
        }
      }
    }


    $router->render('categorias/cat_editar', ['categoria' => $categoria, 'alertas' => $alertas]);
  }
}
