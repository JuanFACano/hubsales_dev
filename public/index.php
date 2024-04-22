<?php

require_once __DIR__ . '/../includes/app.php';

use Controllers\APIController;
use Controllers\CategoriaController;
use Controllers\GeneralController;
use Controllers\LoginController;
use Controllers\ProductoController;
use Controllers\UsuarioController;
use Controllers\ClienteController;
use Controllers\FacturaController;
use MVC\Router;

session_start();
$router = new Router();

// ? -------------------------------------------------------------------------------------------
// ? Vista Login
$router->get('/', [LoginController::class, 'login']);
$router->post('/', [LoginController::class, 'login']);

if (array_key_exists('user_login', $_SESSION) && $_SESSION['user_login']) {

  // ? -------------------------------------------------------------------------------------------
  // ? Vista Logout
  $router->get('/logout', [LoginController::class, 'logout']);


  // ? -------------------------------------------------------------------------------------------
  // ? Vista Productos
  $router->get('/productos', [ProductoController::class, 'index']);
  $router->post('/productos', [ProductoController::class, 'search']);

  // ? Crear Producto
  $router->get('/productos/crear', [ProductoController::class, 'crear']);
  $router->post('/productos/crear', [ProductoController::class, 'crear']);

  // ?? Editar Producto
  $router->get('/productos/editar', [ProductoController::class, 'editar']);
  $router->post('/productos/editar', [ProductoController::class, 'editar']);


  // ? Eliminar Producto
  $router->post('/api/eliminar/producto', [APIController::class, 'eliminarProducto']);


  // ? -------------------------------------------------------------------------------------------
  // ? Vista Clientes
  $router->get('/clientes', [ClienteController::class, 'index']);
  $router->post('/clientes', [ClienteController::class, 'search']);

  // ? crear Cliente
  $router->get('/clientes/crear', [ClienteController::class, 'crear']);
  $router->post('/clientes/crear', [ClienteController::class, 'crear']);

  // ? Editar Cliente
  $router->get('/clientes/editar', [ClienteController::class, 'editar']);
  $router->post('/clientes/editar', [ClienteController::class, 'editar']);

  // ? Eliminar Cliente
  $router->post('/api/eliminar/cliente', [APIController::class, 'eliminarCliente']);


  // ? -------------------------------------------------------------------------------------------
  // ? Vista Categorias}
  $router->get('/categorias', [CategoriaController::class, 'index']);

  // ? Crear Categoria
  $router->get('/categorias/crear', [CategoriaController::class, 'crear']);
  $router->post('/categorias/crear', [CategoriaController::class, 'crear']);

  // ? Editar Categoria
  $router->get('/categorias/editar', [CategoriaController::class, 'editar']);
  $router->post('/categorias/editar', [CategoriaController::class, 'editar']);


  // ? Eliminar Categoria
  $router->post('/api/eliminar/categoria', [APIController::class, 'eliminarCategoria']);


  // ? -------------------------------------------------------------------------------------------
  // ? Vista Facturas
  $router->get('/facturas', [FacturaController::class, 'index']);
  $router->post('/facturas', [FacturaController::class, 'index']);

  $router->get('/facturas/crear', [FacturaController::class, 'crear']);

  // api buscar ingresar a tabla
  $router->get('/api/productos', [APIController::class, 'buscar']);
  $router->post('/api/productos', [APIController::class, 'buscar']);

  // api buscar autocompletar
  $router->get('/api/productos/buscar', [APIController::class, 'autoComplete']);
  $router->post('/api/productos/buscar', [APIController::class, 'autoComplete']);



  // ? Vistas para usuario administrador
  if ($_SESSION['user_rol'] === 1) {

    // ? -------------------------------------------------------------------------------------------
    // ? vista general
    $router->get('/general', [GeneralController::class, 'index']);
    $router->post('/general', [GeneralController::class, 'index']);

    // ? -------------------------------------------------------------------------------------------
    // ? Vista Usuarios 
    $router->get('/usuarios', [UsuarioController::class, 'index']);
    $router->post('/usuarios', [UsuarioController::class, 'search']);

    // ? Crear Usuarios
    $router->get('/usuarios/crear', [UsuarioController::class, 'crear']);
    $router->post('/usuarios/crear', [UsuarioController::class, 'crear']);

    // ? Editar Usuarios
    $router->get('/usuarios/editar', [UsuarioController::class, 'editar']);
    $router->post('/usuarios/editar', [UsuarioController::class, 'editar']);

    // ? Eliminar Usuarios
    $router->post('/api/eliminar/usuario', [APIController::class, 'eliminarUsuario']);

    // ? -------------------------------------------------------------------------------------------
    // ? Vista Mensaje 

    $router->get('/confirmar', [UsuarioController::class, 'confirmar']);

    // ? -------------------------------------------------------------------------------------------
    // ? Vista Confirmar
    $router->get('/mensaje', [UsuarioController::class, 'mensaje']);
  }
}

// Comprobar y validar las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();
