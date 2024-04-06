<?php

namespace Controllers;

use MVC\Router;

class GeneralController
{
  public static function general(Router $router)
  {
    $router->render('layout/general');
  }
}
