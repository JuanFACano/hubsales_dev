<?php

namespace Model;

use Classes\QueryBuilder;
use PDO;

class ActiveRecord
{

    // Base DE DATOS
    protected static $db;
    protected static $tabla = '';
    protected static $columnasDB = [];

    // Alertas y Mensajes
    protected static $alertas = [];

    // Definir la conexión a la BD - includes/database.php
    public static function setDB($database)
    {
        self::$db = $database;
    }

    public static function setAlerta($tipo, $mensaje)
    {
        static::$alertas[$tipo][] = $mensaje;
    }

    // Validación
    public static function getAlertas()
    {
        return static::$alertas;
    }

    public function validar()
    {
        static::$alertas = [];
        return static::$alertas;
    }

    // Consulta SQL para crear un objeto en Memoria
    public static function consultarSQL($query)
    {
        // Consultar la base de datos
        $resultado = self::$db->prepare($query);
        $resultado->execute();

        // Iterar los resultados
        $array = [];
        while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)) {
            $array[] = static::crearObjeto($registro);
        }

        // liberar la memoria
        $resultado->closeCursor();

        // retornar los resultados
        return $array;
    }

    // Crea el objeto en memoria que es igual al de la BD
    protected static function crearObjeto($registro)
    {
        $objeto = new static;
        foreach ($registro as $key => $value) {

            if (property_exists($objeto, $key)) {
                $objeto->$key = $value;
            }
        }

        return $objeto;
    }

    // Identificar y unir los atributos de la BD
    public function atributos()
    {
        $atributos = [];
        foreach (static::$columnasDB as $columna) {

            if ($columna === static::$columnasDB[0]) {
                continue;
            }

            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    // Sanitizar los datos antes de guardarlos en la BD
    public function sanitizarAtributos()
    {
        $atributos = $this->atributos();
        $sanitizado = [];

        foreach ($atributos as $key => $value) {
            if (is_string($value) && strlen($value) < 60) {
                $sanitizado[$key] = strtolower($value);
            } else {
                $sanitizado[$key] = $value;
            }
        }
        return $sanitizado;
    }

    // sanitizar datos
    public function sanitizarDatos($exs = "")
    {
        $objeto = $this;

        $atributos = $this->atributos();

        $sanitizado = [];
        foreach ($atributos as $key => $value) {
            if (is_string($value) && strlen($value) < 60) {
                $sanitizado[$key] = normalizeStr($value);
            } else {
                $sanitizado[$key] = $value;
            }
        }
        // $objeto = static::crearobjetoBuilder($sanitizado, false);
        foreach ($objeto as $key => $value) {
            if ($key == $exs) {
                unset($objeto->$key);
            }
        }
        $this->sincronizar($sanitizado);
    }

    // Sincroniza BD con Objetos en memoria
    public function sincronizar($args = [])
    {

        foreach ($args as $key => $value) {

            if (property_exists($this, $key) && !is_null($value)) {
                $this->$key = $value;
            }
        }
    }

    // Todos los registros
    public static function all()
    {
        $query = "SELECT * FROM " . static::$tabla;
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    // Busca un registro por su id
    public static function find($campo_value, $campo)
    {
        $query = "SELECT * FROM " . static::$tabla . " WHERE {$campo} = {$campo_value}";
        $resultado = self::consultarSQL($query);
        return array_shift($resultado);
    }

    // Busca un registro por su id
    public static function where($columna, $valor)
    {
        $query = "SELECT * FROM " . static::$tabla . " WHERE {$columna} = '{$valor}'";
        $resultado = self::consultarSQL($query);
        return array_shift($resultado);
    }

    // Obtener Registros con cierta cantidad
    public static function get($limite)
    {
        $query = "SELECT * FROM " . static::$tabla . " LIMIT {$limite}";
        $resultado = self::consultarSQL($query);
        return array_shift($resultado);
    }

    // crea un nuevo registro
    public function crear()
    {
        // Sanitizar los datos
        $atributos = $this->sanitizarAtributos();
        // Insertar en la base de datos
        $query = " INSERT INTO " . static::$tabla . " ( ";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES (' ";
        $query .= join("', '", array_values($atributos));
        $query .= "')";
        // Resultado de la consulta
        $resultado = self::$db->prepare($query);
        $resultado->execute();

        return [
            'resultado' => $resultado,
            'id'        => self::$db->lastInsertId,
        ];
    }

    // Actualizar el registro
    public function actualizar($id_base)
    {

        // Sanitizar los datos
        $atributos = $this->sanitizarAtributos();

        // Iterar para ir agregando cada campo de la BD
        $valores = [];

        foreach ($atributos as $key => $value) {
            $valores[] = "{$key}='{$value}'";
        }

        // Consulta SQL
        $query = "UPDATE " . static::$tabla . " SET ";
        $query .= join(', ', $valores);
        $query .= " WHERE " . $id_base . " = '" . $this->$id_base . "'";

        // Actualizar BD
        $resultado = self::$db->prepare($query);
        $resultado->execute();
        return $resultado;
    }

    // Eliminar un Registro por su ID
    public function eliminar($id_base, $id)
    {
        $query = "DELETE FROM " . static::$tabla . " WHERE " . $id_base . " = " . $id;
        $resultado = self::$db->prepare($query);
        $resultado->execute();
        return $resultado;
    }

    // Query Builder

    // funcion para consultar query especializado en JOIN_ALL
    public static function consultarSQLBuilderAll($campos, $tablas_join, $columnas)
    {
        $query = QueryBuilder::joinAll($campos, $tablas_join, $columnas, self::$db);
        // Consultar la base de datos
        $resultado = self::$db->prepare($query);
        $resultado->execute();
        // Iterar los resultados
        $array = [];
        while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)) {
            $array[] = static::crearobjetoBuilder($registro);
        }

        // liberar la memoria
        $resultado->closeCursor();

        // retornar los resultados
        return $array;
    }

    public static function consultarSQLFind($campos, $tablas_join, $columnas, $column, $column_value, $all = false)
    {
        if ($all) {
            $query = QueryBuilder::findAll($campos, $tablas_join, $columnas, $column, $column_value);
        } else {
            $query = QueryBuilder::find($campos, $tablas_join, $columnas, $column, $column_value);
        }

        // Consultar la base de datos
        $resultado = self::$db->prepare($query);
        $resultado->execute();
        $array = [];
        while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)) {
            $array[] = static::crearobjetoBuilder($registro);
        }
        return $array;
    }


    // funcion para crear objeto de tipo especializado en JOIN_ALL
    public static function crearobjetoBuilder($registro, $limpio = true)
    {
        $objeto = new static;
        foreach ($registro as $key => $value) {
            $objeto->$key = $value;
        }

        if ($limpio) {
            $objeto = self::limpiarObjeto($objeto);
        }

        return $objeto;
    }

    public static function limpiarObjeto($objeto)
    {
        foreach ($objeto as $key => $value) {
            if (property_exists($objeto, $key) && $value == "" || is_null($value)) {
                unset($objeto->$key);
            }
        }
        return $objeto;
    }
}
