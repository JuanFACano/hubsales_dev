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
}
