<?php

namespace Controllers;

use Classes\Email;
use Model\Usuario;
use MVC\Router;

use function PHPSTORM_META\type;

class UsuarioController
{
    protected static $campos = ['user_nombre', 'rol_nombre', 'user_correo'];
    protected static $tablas_join = ['usuarios', 'roles'];
    protected static  $columnas = ['user_rol', 'rol_id'];
    public static function index(Router $router)
    {
        $usuariosJoin = Usuario::queryBuilderAll(self::$campos, self::$tablas_join, self::$columnas);

        $router->render('usuarios/usuario', $usuariosJoin);
    }

    public static function crear(Router $router)
    {
        // ? Instanciar Usuario
        $usuario = new Usuario($_POST);

        // ? Alertas Vacias
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            //? Sincronizacion de datos del usuario y validaciond de campos del formulario
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarNuevoUsuario();

            if (empty($alertas)) {
                // ? verificar usuario parfa evitar duplicados
                $resultado = $usuario->existeUsuario();

                if ($resultado->rowCount()) {
                    $alertas = Usuario::getAlertas();
                } else {
                    // Hash Password
                    $usuario->hashPassword();

                    // Generar Token
                    $usuario->crearToken();

                    // send Emai
                    $email = new Email($usuario->user_correo, $usuario->user_nombre, $usuario->token);
                    $email->enviarConfirmacion();

                    // crear usuario
                    $resultado = $usuario->guardar();

                    if ($resultado) {
                        header('Location: /mensaje');
                    }
                }
            }
        }

        $router->render('usuarios/crear_usuario', ['usuario' => $usuario, 'alertas' => $alertas]);
    }

    public static function mensaje(Router $router)
    {
        $router->render('usuarios/mensaje');
    }

    public static function confirmar(Router $router)
    {
        $alertas = [];
        $token = s($_GET['token']);
        $usuario = Usuario::where('token', $token);

        if (empty($usuario)) {
            // ? Mostar mensaje de error
            Usuario::setAlerta('error', 'Token No Valido');
        } else {
            // ? Modificar Usuario
            $usuario->confirmado = "1";
            $usuario->token = NULL;
            $usuario->guardar('user_id');
            Usuario::setAlerta('exito', "Cuenta comprobada correctamente");
        }

        // ? Obtener alertas
        $alertas = Usuario::getAlertas();

        // ? render a la vista
        $router->render('usuarios/confirmar-cuenta', [
            'alertas' => $alertas,
        ]);
    }
}
