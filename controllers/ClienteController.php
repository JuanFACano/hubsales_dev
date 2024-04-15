<?php

namespace Controllers;

use Model\Cliente;
use MVC\Router;

class ClienteController
{
  protected static $campos = ['cli_id', 'cli_nombre', 'cli_cedula', 'cli_direccion', 'cli_correo', 'cli_telefono'];
  protected static $column_id = 'cli_id';
  protected static $column_search = 'cli_cedula';

  public static function index(Router $router, $alertas = [])
  {
    $clientes = Cliente::all();
    $router->render('clientes/index', ["clientes" => $clientes, "alertas" => $alertas]);
  }

  public static function crear(Router $router)
  {
    $cliente = new Cliente($_POST);
    $alertas = [];

    if ($_SERVER['REQUEST_METHOD'] === "POST") {
      $cliente->sincronizar();
      $alertas = $cliente->validarCliente();
      if (empty($alertas)) {
        $resultado = $cliente->existeCliente();
        $cliente->sanitizarDatos();

        if ($resultado->rowCount()) {
          $alertas = Cliente::getAlertas();
        } else {
          $resultado = $cliente->crear();

          if ($resultado) {
            header("location: /clientes");
          }
        }
      }
    }

    $router->render('clientes/cli_crear', ["cliente" => $cliente, "alertas" => $alertas]);
  }

  public static function editar(Router $router)
  {
    $id_get = $_GET['id'];
    $cliente = new Cliente($_POST);
    $alertas = [];

    $clienteEdit = Cliente::find($id_get, self::$column_id);
    if ($_SERVER['REQUEST_METHOD'] === "POST") {
      $cliente->sincronizar($_POST);
      $alertas = $cliente->validarCliente();

      if (empty($alertas)) {
        $cliente->cli_id = $clienteEdit->cli_id;

        $resultado = $cliente->actualizar(self::$column_id);

        if ($resultado) {
          header('location: /clientes');
        } else {
          $alertas['error'][] = "No se pudo actualizar";
          $alertas = $cliente::getAlertas();
        }
      }
    }

    $router->render('clientes/cli_editar', ['cliente' => $clienteEdit, 'alertas' => $alertas]);
  }
}
