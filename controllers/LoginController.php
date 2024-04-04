<?php

namespace Controllers;

use MVC\Router;

class LoginController
{
  public static function login(Router $router)
  {
    $router->render('auth/login', [], false);
  }

  public static function logout(Router $router)
  {
    $router->render('auth/logout');
  }

  public static function crear(Router $router)
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    }

    $router->render('auth/usuario');
  }
}
