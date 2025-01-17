<?php
namespace MVC;

class Router {
    public array $getRoutes = [];
    public array $postRoutes = [];

    public function get($url, $fn) {
        $this->getRoutes[$url] = $fn;
    }

    public function post($url, $fn) {
        $this->postRoutes[$url] = $fn;
    }

    public function comprobarRutas() {
        //proteger rutas...
        session_start();

        $currentUrl = strtok($_SERVER['REQUEST_URI'], '?');
        $method = $_SERVER['REQUEST_METHOD'];

        if($method === 'GET') {
            $fn = $this->getRoutes[$currentUrl] ?? null;
        } else {
            $fn = $this->postRoutes[$currentUrl] ?? null;
        }

        if($fn) {
            //Call user fn va a llamar una funcion cuando no sabemos cual sera
            call_user_func($fn, $this); //This es para pasar argumentos
        } else {
            echo "Página No Encontrada o Ruta no válida";
        }
    }

    public function render($view, $datos = []) {
        //Leer lo que pasamos a la vista
        foreach($datos as $key => $value) {
            $$key = $value; //Doble signo significa: variable variable, básicamente nuestra variable sigue siendo la original, pero al 
                            //asignarla a otra no la reescribe, mantiene su valor, de esta forma el nombre de la variable se asigna dinamicamente
        }

        ob_start(); //almacenamiento en memoria durante un momento...

        //entonces incluimos la vista en el layout
        include_once __DIR__ . "/views/$view.php";

        $contenido = ob_get_clean(); //Limpia el buffer

        //Utilizar el layout de acuerdo a la URL
        $url_actual = $_SERVER['PATH_INFO'] ?? '/';

        if(str_contains($url_actual, '/admin')) {
            include_once __DIR__ . '/views/admin-layout.php';
        } else {
            include_once __DIR__ . '/views/layout.php';
        }
    }
}