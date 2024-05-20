<?php

namespace Controllers;

use Model\Producto;

class ApiProductoController {
    public static function index() {
        $productos = Producto::all();
        
        $respuesta = [
            'productos' => $productos
        ];

        echo json_encode($respuesta);
    }

    public static function eliminar() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];

            if(filter_var($id, FILTER_VALIDATE_INT)) {
                $producto = Producto::find($id);
                $producto->eliminar();
            }

            $respuesta =  [
                'tipo' => 'exito',
                'mensaje' => 'Producto eliminado correctamente'
            ];

            echo json_encode($respuesta);
        }
    }
}