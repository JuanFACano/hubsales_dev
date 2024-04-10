<?php

namespace Controllers;

use MVC\Router;

class GeneralController
{
  public static function index(Router $router)
  {
    $router->render('layout/general');
  }
}
