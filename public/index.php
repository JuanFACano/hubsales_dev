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

if (array_key_exists('user_login', $_SESSION) && $_SESSION['user_login']) {

  // ? Cerrar sesión
  $router->get('/logout', [LoginController::class, 'logout']);

  // ? Productos
  $router->get('/productos', [ProductoController::class, 'index']);

  // ? Vistas para usuario administrador
  if ($_SESSION['user_rol'] === 1) {

    // ? vista general
    $router->get('/general', [GeneralController::class, 'index']);
    $router->post('/general', [GeneralController::class, 'index']);

    // ? Vista Usuarios
    $router->get('/usuarios', [UsuarioController::class, 'index']);
    $router->post('/usuarios', [UsuarioController::class, 'search']);

    // ? Vista Crear Usuarios
    $router->get('/usuarios/crear', [UsuarioController::class, 'crear']);
    $router->post('/usuarios/crear', [UsuarioController::class, 'crear']);

    // ? Vista Editar Usuarios
    $router->get('/usuarios/editar', [UsuarioController::class, 'editar']);
    $router->post('/usuarios/editar', [UsuarioController::class, 'editar']);


    $router->post('/api/eliminar/usuario', [APIController::class, 'eliminarUsuario']);

    // ? Vista Mensaje Confirmar Cuenta
    $router->get('/confirmar', [UsuarioController::class, 'confirmar']);

    // ? Vista Confirmar Cuenta
    $router->get('/mensaje', [UsuarioController::class, 'mensaje']);
  }
}

// Comprobar y validar las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();
