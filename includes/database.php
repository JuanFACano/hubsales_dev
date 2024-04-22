<?php

include('config.php');

class Conexion
{
    public static function conectar()
    {
        try {
            $dsn = "pgsql:host=" . SERVER . "; port=5432; dbname=" . DBNAME . ";options='--client_encoding=UTF8'";
            $conexion = new PDO($dsn, USER, PASSWORD, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
            return $conexion;
        } catch (Exception $error) {
            die("El error de conexion es: " . $error->getMessage());
        }
    }
}
