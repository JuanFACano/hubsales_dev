<?php

require_once __DIR__ . '/../includes/app.php';

use Controllers\GeneralController;
use Controllers\LoginController;
use Controllers\UsuarioController;
use MVC\Router;

$router = new Router();

// ? Iniciar sesion
$router->get('/', [LoginController::class, 'login']);
$router->post('/', [LoginController::class, 'login']);

// ? Cerrar sesión
$router->get('/logout', [LoginController::class, 'logout']);

// ? vista general
$router->get('/general', [GeneralController::class, 'general']);
$router->post('/general', [GeneralController::class, 'general']);

// ? Vista Usuarios
$router->get('/usuarios', [UsuarioController::class, 'usuarios']);
$router->post('/usuarios', [UsuarioController::class, 'usuarios']);

// ? Vista Crear Usuarios
$router->get('/usuarios/crear', [UsuarioController::class, 'crear']);
$router->post('/usuarios/crear', [UsuarioController::class, 'crear']);

// ? Vista Confirmar Cuenta
$router->get('/confirmar-cuenta', [UsuarioController::class, 'confirmar']);
$router->get('/mensaje', [UsuarioController::class, 'mensaje']);

// Comprobar y validar las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();
