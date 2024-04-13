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
}
