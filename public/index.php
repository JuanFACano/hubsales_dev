<?php

require_once __DIR__ . '/../includes/app.php';

use Controllers\GeneralController;
use Controllers\LoginController;
use Controllers\UsuarioController;
use MVC\Router;

$router = new Router();

$router->get('/', [LoginController::class, 'login']);
$router->post('/', [LoginController::class, 'login']);

$router->get('/logout', [LoginController::class, 'logout']);

$router->get('/crear-cuenta', [LoginController::class, 'crear']);
$router->post('/crear-cuenta', [LoginController::class, 'crear']);


$router->get('/general', [GeneralController::class, 'general']);
$router->post('/general', [GeneralController::class, 'general']);

$router->get('/usuarios', [UsuarioController::class, 'usuarios']);
$router->post('/usuarios', [UsuarioController::class, 'usuarios']);

$router->get('/usuarios/crear', [UsuarioController::class, 'crear']);
$router->post('/usuarios/crear', [UsuarioController::class, 'crear']);


// Comprobar y validar las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();
