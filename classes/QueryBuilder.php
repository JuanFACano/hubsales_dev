<?php

namespace Classes;

class QueryBuilder
{
  public static function  joinAll($campos, $tablas_join, $columnas)
  {
    $camposString = implode(', ', $campos);
    $tableString = implode(' INNER JOIN ', $tablas_join);
    $columnasString = implode(' = ', $columnas);
    $query = "SELECT $camposString FROM $tableString ON $columnasString";
    return $query;
  }

  public static function find($campos, $tablas_join, $columnas, $column, $column_value)
  {
    $camposString = implode(', ', $campos);
    $tableString = implode(' INNER JOIN ', $tablas_join);
    $columnasString = implode(' = ', $columnas);
    $query = "SELECT $camposString FROM $tableString ON $columnasString WHERE $column = '$column_value'";
    return $query;
  }

  public static function findAll($campos, $tablas_join, $columnas, $column, $column_value)
  {
    $camposString = implode(', ', $campos);
    $tableString = implode(' INNER JOIN ', $tablas_join);
    $columnasString = implode(' = ', $columnas);
    $query = "SELECT $camposString FROM $tableString ON $columnasString WHERE $column ILIKE '%$column_value%'";
    return $query;
  }

  public static function findSearch($tabla, $campo_value, $campo)
  {
    $query = "SELECT * FROM $tabla WHERE {$campo} ILIKE '%{$campo_value}%'";
    return $query;
  }

  public static function joinAllMore($campos, $tablas_join, $columnas, $columns_id)
  {
    $camposString = implode(', ', $campos);
    $tablesString = implode(', ', $tablas_join);
    $columnString = implode(', ', $columnas);
    $query = "SELECT $camposString FROM $tablas_join[0] INNER JOIN $tablas_join[1] ON $tablas_join[0].$columns_id[0] = $columnas[1] INNER JOIN $tablas_join[2] on $tablas_join[0].$columns_id[1] = $columnas[2]";

    return $query;
  }

  public static function search($buscar)
  {

    $query = "SELECT prod_id, prod_sku, prod_nombre, prod_precio_unitario, prod_existencias FROM productos WHERE prod_sku LIKE '" . $buscar . "%' OR prod_nombre LIKE '" . $buscar . "%'";
    return $query;
  }
}
