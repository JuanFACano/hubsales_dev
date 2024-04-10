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

// ? Iniciar sesion
$router->get('/', [LoginController::class, 'login']);
$router->post('/', [LoginController::class, 'login']);
if ($_SESSION['user_login']) {

  if ($_SESSION['user_rol'] === 1) {

    // ? vista general
    $router->get('/general', [GeneralController::class, 'index']);
    $router->post('/general', [GeneralController::class, 'index']);

    // ? Vista Usuarios
    $router->get('/usuarios', [UsuarioController::class, 'index']);
    $router->post('/usuarios', [UsuarioController::class, 'index']);

    // ? Vista Crear Usuarios
    $router->get('/usuarios/crear', [UsuarioController::class, 'crear']);
    $router->post('/usuarios/crear', [UsuarioController::class, 'crear']);

    $router->get('/confirmar-cuenta', [UsuarioController::class, 'confirmar']);
  }

  // ? Cerrar sesión
  $router->get('/logout', [LoginController::class, 'logout']);

  // ? Vista Confirmar Cuenta
  $router->get('/mensaje', [UsuarioController::class, 'mensaje']);

  // Productos
  $router->get('/productos', [ProductoController::class, 'index']);

  // API
  $router->get('/api/productos', [APIController::class, 'index']);

  // Comprobar y validar las rutas, que existan y les asigna las funciones del Controlador
}

$router->comprobarRutas();
