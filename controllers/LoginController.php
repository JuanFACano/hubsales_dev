<?php

namespace Controllers;

use Model\Usuario;
use MVC\Router;

class LoginController
{
    public static function login(Router $router)
    {
        $alertas = [];
        $auth = new Usuario;
        if (array_key_exists('user_login', $_SESSION) && $_SESSION['user_login']) {
            $user = $_SESSION['user_rol'];

            if ($user === 1) {
                header('Location: /general');
            } else if ($user === 2) {
                header('Location: /productos');
            }
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new Usuario($_POST);
            $alertas = $auth->valdiarLogin();

            if (empty($alertas)) {
                // comprobar que usuario exista
                $usuario = Usuario::where('user_correo', $auth->user_correo);

                if ($usuario) {

                    // ? Verificar contraseña
                    if ($usuario->comprobarContraseniaAndConfirmado($auth->user_contrasenia)) {
                        session_start();

                        $_SESSION['user_id'] = $usuario->user_id;
                        $_SESSION['user_nombre'] = $usuario->user_nombre . " " . $usuario->user_apellido;
                        $_SESSION['user_primer_nombre'] = $usuario->user_nombre;
                        $_SESSION['user_correo'] = $usuario->user_correo;
                        $_SESSION['user_login'] = true;

                        // Redireccionamiento
                        if ($usuario->user_rol === 1) {
                            $_SESSION['user_rol'] = $usuario->user_rol ?? null;
                            header('Location: /general');
                        } else if ($usuario->user_rol === 2) {
                            $_SESSION['user_rol'] = $usuario->user_rol ?? null;
                            header('Location: /productos');
                        }
                    }
                } else {
                    Usuario::setAlerta('error', 'Usuario no registrado');
                }
            }
        }

        $alertas = Usuario::getAlertas();

        $router->render('auth/login', [
            'alertas' => $alertas,
            'auth'    => $auth,
        ], false);
    }

    public static function logout()
    {
        $_SESSION = [];
        header('Location: /');
    }

    public static function crear(Router $router)
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        }

        $router->render('auth/usuario');
    }
}
