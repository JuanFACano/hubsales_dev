<?php

namespace Controllers;

use Model\Cliente;
use Model\Factura;
use Model\Producto;
use Model\Usuario;
use MVC\Router;

class FacturaController
{
  protected static $tabla = "facturas";
  protected static $campos = [
    'fac_id',
    'fac_fecha',
    'fac_fecha_venc',
    'cli_cedula',
    'user_nombre',
    'user_apellido',
    'fac_numero_factura',
  ];


  protected static $column_id = 'fac_id';
  protected static $column_search = 'fac_id';
  protected static $tablas_join = ['facturas', 'clientes', 'usuarios'];
  protected static $columns_id = ['fac_cli_id', 'fac_user_id'];
  protected static  $columnas = ['fac_id', 'cli_id', 'user_id'];


  public static function index(Router $router, $alertas = [])
  {
    $factura = Factura::consultarSQLBuilderAllMore(self::$campos, self::$tablas_join, self::$columnas, self::$columns_id);
    $router->render('facturas/index', ["facturas" => $factura, "alertas" => $alertas]);
  }

  public static function crear(Router $router)
  {
    $productos = self::getProductos();
    $usuarios = self::getUsuarios();
    $clientes = self::getClientes();

    $factura = new Factura($_POST);
    $alertas = [];

    if ($_SERVER['REQUEST_METHOD'] === "POST") {
      $factura->sincronizar();
      $alertas = $factura->validarCliente();

      if (empty($alertas)) {
        $resultado = $factura->existeCliente();
        $factura->sanitizarDatos();

        if ($resultado->rowCount()) {
          $alertas = Cliente::getAlertas();
        } else {
          $resultado = $factura->crear();

          if ($resultado) {
            header("location: /clientes");
          }
        }
      }
    }

    $router->render('facturas/fac_crear', [
      "factura" => $factura,
      "alertas" => $alertas,
      "usuarios" => $usuarios,
      "productos" => $productos,
      "clientes" => $clientes
    ], false);
  }

  public static function editar(Router $router)
  {
    $id_get = $_GET['id'];
    $cliente = new Cliente($_POST);
    $alertas = [];

    $clienteEdit = Cliente::find($id_get, self::$column_id);

    if ($_SERVER['REQUEST_METHOD'] === "GET") {
      $cliente->sincronizar($clienteEdit);
      $alertas = $cliente->clienteEncontrado($id_get);
    } else {
      $cliente->sincronizar($_POST);
      $cliente->cli_id = $clienteEdit->cli_id;

      $cliente->sanitizarAtributos();
      $alertas = $cliente->validarCliente();

      if (empty($alertas)) {
        $cliente->sanitizarDatos();
        $resultado = $cliente->actualizar(self::$column_id);

        if ($resultado) {
          header('location: /clientes');
        } else {
          $alertas['error'][] = "No se pudo actualizar";
          $alertas = $cliente::getAlertas();
        }
      }
    }


    $router->render('clientes/cli_editar', ['cliente' => $cliente, 'alertas' => $alertas]);
  }

  public static function search(Router $router)
  {
    $alertas = [];
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $searchDB = $_POST['search'];
      $search = normalizeStr($searchDB);
      $cliente = new Cliente;
      $alertas = $cliente->validarBusqueda($search);

      if (empty($alertas)) {
        $clienteSearch = Cliente::findSearch(self::$tabla, $search, self::$column_search);
        if (!empty($clienteSearch)) {
          $router->render('clientes/index', ["clientes" => $clienteSearch, "alertas" => $alertas]);
        } else {
          Cliente::setAlerta('error', 'No se encontro el usuario');
        }
      }

      $alertas = Cliente::getAlertas();
      static::index($router, $alertas);
    }
  }

  public static function getProductos()
  {
    $productos = Producto::all();
    return $productos;
  }

  public static function getUsuarios()
  {
    $usuarios = Usuario::all();
    return $usuarios;
  }

  public static function getClientes()
  {
    $clientes = Cliente::all();
    return $clientes;
  }
}
