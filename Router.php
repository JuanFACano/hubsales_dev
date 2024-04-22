<?php

namespace MVC;

class Router
{
    public array $getRoutes = [];
    public array $postRoutes = [];

    public function get($url, $fn)
    {
        $this->getRoutes[$url] = $fn;
    }

    public function post($url, $fn)
    {
        $this->postRoutes[$url] = $fn;
    }

    public function comprobarRutas()
    {

        $currentUrl = $_SERVER['PATH_INFO'] ?? '/';
        $method = $_SERVER['REQUEST_METHOD'];

        if ($method === 'GET') {
            $fn = $this->getRoutes[$currentUrl] ?? null;
        } else {
            $fn = $this->postRoutes[$currentUrl] ?? null;
        }

        if ($fn) {
            call_user_func($fn, $this); // Call user fn va a llamar una función cuando no sabemos cual sera
        }
    }

    public function render($view, $datos = [], $layout = true)
    {
        $datos_base = $datos;
        foreach ($datos as $key => $value) {
            $$key = $value;  // Doble signo de dolar significa: variable variable, básicamente nuestra variable sigue siendo la original, pero al asignarla a otra no la reescribe, mantiene su valor, de esta forma el nombre de la variable se asigna dinamicamente
        }
        if ($layout) {
            ob_start(); // Almacenamiento en memoria durante un momento...

            // entonces incluimos la vista en el layout
            include_once __DIR__ . "/views/$view.php";
            $contenido = ob_get_clean(); // Limpia el Buffer
            include_once __DIR__ . '/views/layout.php';
        } else {
            include_once __DIR__ . "/views/$view.php";
        }
    }
}
