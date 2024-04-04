<?php

namespace Controllers;

use MVC\Router;

class LoginController
{
  public static function login(Router $router)
  {
    $router->render('auth/login');
  }

  public static function logout()
  {
    echo "Desde logout";
  }

  public static function crear()
  {
    echo "Desde Crear";
  }
}
