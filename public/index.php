<?php

require_once __DIR__ . '/../includes/app.php';

use Controllers\APIController;
use Controllers\CategoriaController;
use Controllers\GeneralController;
use Controllers\LoginController;
use Controllers\ProductoController;
use Controllers\UsuarioController;
use Controllers\ClienteController;
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


  // ? Eliminar Producto
  $router->post('/api/eliminar/producto', [APIController::class, 'eliminarProducto']);

  // ? -------------------------------------------------------------------------------------------
  // ? Vista Clientes
  $router->get('/clientes', [ClienteController::class, 'index']);

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
