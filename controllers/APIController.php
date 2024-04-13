<?php

namespace Controllers;

use Model\Usuario;

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
}
