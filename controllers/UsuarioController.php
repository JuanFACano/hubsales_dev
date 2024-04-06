<?php

namespace Controllers;

use MVC\Router;

class UsuarioController
{
  public static function usuarios(Router $router)
  {
    $router->render('layout/usuario');
  }
}
