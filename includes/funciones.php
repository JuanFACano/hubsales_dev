<?php

function debuguear($variable): string
{
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

function getView($obj)
{
    $a = get_class($obj);
    $objArray = explode("\\", $a);
    $view = $objArray[1];
    return strtolower($view);
}

// Escapa / Sanitizar el HTML
function s($html): string
{
    $s = htmlspecialchars($html);
    return $s;
}

function normalizeStr($str)
{
    $norm = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
    $norm = str_replace('~n', 'ñ', $norm);
    $norm = str_replace('~N', 'ñ', $norm);
    $norm = preg_replace("/[^a-zA-Z0-9ñÑ@._-]+/", "", $norm);
    $norm = strtolower($norm);
    return $norm;
}
