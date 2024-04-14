<?php

namespace Controllers;

use Classes\Email;
use Model\Usuario;
use MVC\Router;


class UsuarioController
{
    protected static $campos = ['user_id', 'user_nombre', 'user_apellido', 'rol_nombre', 'rol_id', 'user_correo'];
    protected static $column_id = 'user_id';
    protected static $column_search = 'user_correo';
    protected static $tablas_join = ['usuarios', 'roles'];
    protected static  $columnas = ['user_rol', 'rol_id'];
    public static function index(Router $router, $alertas = [])
    {
        $usuariosJoin = Usuario::consultarSQLBuilderAll(self::$campos, self::$tablas_join, self::$columnas);
        $router->render('usuarios/index', ["usuarios" => $usuariosJoin, "alertas" => $alertas]);
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
                    $resultado = $usuario->crear();

                    if ($resultado) {
                        header('Location: /mensaje');
                    }
                }
            }
        }

        $router->render('usuarios/user_crear', ['usuario' => $usuario, 'alertas' => $alertas]);
    }

    public static function editar(Router $router)
    {
        $id_get = $_GET['id'];
        $usuario = new Usuario();
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === "GET") {
            $alertas = $usuario->usuarioEncontrado($id_get);
            $campos = ['user_id', 'user_nombre', 'user_apellido', 'rol_id', 'user_correo'];
            $resultado = Usuario::consultarSQLFind($campos, self::$tablas_join, self::$columnas, self::$column_id, $id_get);
        } else {
            if (empty($alertas)) {
                $usuario->sincronizar($_POST);
                header('location: /usuarios');
            }
        }

        $router->render('usuarios/user_editar', ['resultado' => $resultado, 'alertas' => $alertas]);
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
            $usuario->actualizar('user_id');
            Usuario::setAlerta('exito', "Cuenta comprobada correctamente");
        }

        // ? Obtener alertas
        $alertas = Usuario::getAlertas();

        // ? render a la vista
        $router->render('usuarios/confirmar', [
            'alertas' => $alertas,
        ], false);
    }

    public static function search(Router $router)
    {
        $alertas = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $search = s($_POST['search']);
            $usuario = new Usuario;
            $alertas = $usuario->validarBusqueda($search);

            if (empty($alertas)) {
                $usuarioSearch = Usuario::consultarSQLFind(self::$campos, self::$tablas_join, self::$columnas, self::$column_search, $search);

                if (!empty($usuarioSearch)) {
                    $router->render('usuarios/index', ["usuarios" => $usuarioSearch, "alertas" => $alertas]);
                } else {
                    Usuario::setAlerta('error', 'No se encontro el usuario');
                }
            }

            $alertas = Usuario::getAlertas();
            static::index($router, $alertas);
        }
    }
}
