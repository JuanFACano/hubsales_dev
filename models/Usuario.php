<?php

namespace Model;

class Usuario extends ActiveRecord
{
    // Base de Datos
    protected static $tabla = 'usuarios';
    protected static $columnasDB = [
        'user_id',
        'user_nombre',
        'user_apellido',
        'user_rol',
        'user_correo',
        'user_contrasenia',
        'confirmado',
        'token',
    ];

    public $user_id;
    public $user_nombre;
    public $user_apellido;
    public $user_rol;
    public $user_correo;
    public $user_contrasenia;
    public $confirmado;
    public $token;

    public function __construct($args = [])
    {
        $this->user_id = $args['id'] ?? null;
        $this->user_nombre = $args['nombre'] ?? '';
        $this->user_apellido = $args['apellido'] ?? '';
        $this->user_rol = $args['rol'] ?? null;
        $this->user_correo = $args['correo'] ?? '';
        $this->user_contrasenia = $args['contrasenia'] ?? '';
        $this->confirmado = $args['confirmado'] ?? '';
        $this->token = $args['token'] ?? '';
    }

    // ? Mensaje de Validacion para creacion de usuario
    public function validarNuevoUsuario()
    {

        if (!$this->user_nombre) {
            self::$alertas['error'][] = "El nombre es obligatorio";
        } else {
            if (!preg_match('/^[A-Za-z\s]+$/', $this->cli_nombre)) {
                self::$alertas['error'][] = "El nombre debe contener solo texto";
            }
        }

        if (!$this->user_apellido) {
            self::$alertas['error'][] = "El apellido es obligatorio";
        } else {
            if (!preg_match('/^[A-Za-z\s]+$/', $this->cli_apellido)) {
                self::$alertas['error'][] = "El apellido debe contener solo texto";
            }
        }

        if (!$this->user_correo) {
            self::$alertas['error'][] = "El correo es obligatorio";
        } else {
            if (!preg_match('/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $this->cli_correo)) {
                self::$alertas['error'][] = "Ingrese un correo valido";
            }
        }

        if (!$this->user_contrasenia) {
            self::$alertas['error'][] = "La contraseña es obligatoria";
        } else

        if (strlen($this->user_contrasenia) < 6) {
            self::$alertas['error'][] = "Contraseña debe tener al menos 6 caracteres";
        }

        if (!$this->user_rol) {
            self::$alertas['error'][] = "Seleccione un rol";
        }

        return self::$alertas;
    }

    // ? Validar Usuario y contraseña
    public function valdiarLogin()
    {

        if (!$this->user_correo) {
            self::$alertas['error'][] = "El correo es obligatorio";
        }

        if (!$this->user_contrasenia) {
            self::$alertas['error'][] = "La contraseña es obligatoria";
        } else

        if (strlen($this->user_contrasenia) < 6) {
            self::$alertas['error'][] = "Contraseña debe tener al menos 6 caracteres";
        }

        return self::$alertas;
    }

    // ? Revision de usuario existente
    public function existeUsuario()
    {
        $consulta = "SELECT * FROM " . self::$tabla . " WHERE user_correo = '" . $this->user_correo . "' LIMIT 1";
        $resultado = self::$db->prepare($consulta);
        $resultado->execute();

        if ($resultado->rowCount() > 0) {
            self::$alertas['error'][] = "El usuario ya esta registrado";
        }

        return $resultado;
    }

    public function hashPassword()
    {
        $this->user_contrasenia = password_hash($this->user_contrasenia, PASSWORD_BCRYPT);
    }

    public function crearToken()
    {
        $this->token = uniqid();
    }

    public function comprobarContraseniaAndConfirmado($password)
    {
        $resultado = password_verify($password, $this->user_contrasenia);

        if (!$resultado || !$this->confirmado) {
            self::$alertas['error'][] = "Contraseña incorrecta o cuenta no confirmada";
        } else {
            return true;
        }
    }

    public function usuarioEncontrado($id)
    {
        $consulta = "SELECT * FROM " . self::$tabla . " WHERE user_id = '" . $id . "' LIMIT 1";
        $resultado = self::$db->prepare($consulta);
        $resultado->execute();

        if ($resultado->rowCount() == 0) {
            self::$alertas['error'][] = "No se pudo actualizar el usuario";
        }

        return self::$alertas;
    }

    public function validarBusqueda($search)
    {
        if (empty($search)) {
            self::$alertas['error'][] = "ingresar un correo valido";
        }

        return self::$alertas;
    }
}
