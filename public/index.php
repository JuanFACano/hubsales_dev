<?php

require_once __DIR__ . '/../includes/app.php';

use Controllers\APIController;
use Controllers\GeneralController;
use Controllers\LoginController;
use Controllers\ProductoController;
use Controllers\UsuarioController;
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
  $router->post('/productos/crerar', [ProductoController::class, 'crear']);


  // ? Eliminar Producto
  $router->post('/api/eliminar/producto', [APIController::class, 'eliminarProducto']);

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
