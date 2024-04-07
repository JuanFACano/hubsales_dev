<?php

namespace Controllers;

use Model\Usuario;
use MVC\Router;

class UsuarioController
{
  public static function usuarios(Router $router)
  {
    $router->render('layout/usuario');
  }


  public static function crear(Router $router)
  {
    // ? Instanciar Usuario
    $usuario = new Usuario($_POST);

    // ? Alertas Vacias
    $alertas = [];

    if ($_SERVER['REQUEST_METHOD'] === "POST") {
      //? Sincronizacion de datos del usuario y validaciond de campos del formulario
      $usuario->sincronizar($_POST);
      $alertas = $usuario->validarNuevoUsuario();

      // ?
      if (empty($alertas)) {
        // ? verificar usuario parfa evitar duplicados
        $resultado = $usuario->existeUsuario();
        if ($resultado->rowCount()) {
          $alertas = Usuario::getAlertas();
        } else {
          // Hash Password
          $usuario->hashPassword();
          debuguear($usuario);
        }
      }
    }
    $router->render('layout/crear', ['usuario' => $usuario, 'alertas' => $alertas]);
  }
}
