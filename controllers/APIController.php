<?php

namespace Controllers;

use Model\Usuario;
use Model\Producto;

class APIController
{
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
}
