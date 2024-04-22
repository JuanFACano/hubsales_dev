<?php

namespace Controllers;

use Conexion;
use PDO;


use Model\Categoria;
use Model\Cliente;
use Model\Usuario;
use Model\Producto;

class APIController
{

  public static $con;
  public static $pdo;


  public static function eliminarUsuario()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $id = $_POST['id'];

      $usuario = Usuario::find($id, 'user_id');
      $usuario->eliminar('user_id', $id);

      header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
  }

  public static function eliminarProducto()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $id = $_POST['id'];

      $producto = Producto::find($id, 'prod_id');
      $producto->eliminar('prod_id', $id);
      header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
  }

  public static function eliminarCliente()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $id = $_POST['id'];

      $cliente = Cliente::find($id, 'cli_id');
      $cliente->eliminar('cli_id', $id);
      header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
  }

  public static function eliminarCategoria()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $id = $_POST['id'];

      $categoria = Categoria::find($id, 'cat_id');
      $categoria->eliminar('cat_id', $id);
      header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
  }

  public static function buscar()
  {
    $buscar_criterio = $_POST['buscar_criterio'];
    $producto = Producto::probarSearch($buscar_criterio);
    echo json_encode($producto);
  }

  public static function autoComplete()
  {
    $campo = $_POST['fac_campo_buscar'];
    $productos = Producto::probarSearch($campo);

    echo json_encode($productos);
  }
}
