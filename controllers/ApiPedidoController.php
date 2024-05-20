<?php

namespace Controllers;

use Model\Pedido;
use Model\PedidoProducto;
use Model\Producto;

class ApiPedidoController
{

    public static function obtenerProducto()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //validar que el cliente exista
            $codigo = $_POST['codigo'];
            $producto = Producto::where('codigo', $codigo);

           

            $respuesta = [
                'tipo' => 'exito',
                'producto' => $producto
            ];

            echo json_encode($respuesta);
        }
    }

    public static function crear()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //validar que el cliente exista
            $pedido = new Pedido($_POST);
            $pedido->sincronizar($_POST);

            $pedido->guardar();

            $respuesta = [
                'tipo' => 'exito',
                'pedidoId' => $pedido['id']
            ];

            echo json_encode($respuesta);
        }
    }
}
