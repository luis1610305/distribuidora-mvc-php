<?php
namespace Controllers;

use Model\Cliente;
use MVC\Router;
use Model\Pedido;
use Model\PedidoProducto;

class PedidoController {
    public static function index(Router $router) {
        //Consultar a la base de datos
        $query = "SELECT pedidos.id, pedidos.fecha, pedidos.clienteId, clientes.nombre, pedidos.estado FROM pedidos";
        $query .= " LEFT OUTER JOIN clientes";
        $query .= " ON pedidos.clienteId = clientes.id;";

        $pedidos = Pedido::SQL($query);

        $router->render('admin/pedidos/index', [
            'pedidos' => $pedidos
        ]);
    }

    public static function pedido(Router $router) {
        $id = $_GET['id'];

        //Consultar la base de datos
        $query = "SELECT pedidoProducto.id, pedidos.fecha, clientes.nombre AS cliente, productos.codigo, productos.descripcion AS producto, pedidoproducto.cantidad, pedidoproducto.peso, productos.precio FROM pedidoProducto";
        $query .= " LEFT OUTER join pedidos ";
        $query .= " ON pedidoProducto.pedidoId = pedidos.id";
        $query .= " LEFT OUTER JOIN clientes";
        $query .= " ON pedidos.clienteId = clientes.id";
        $query .= " LEFT OUTER JOIN productos";
        $query .= " ON pedidoProducto.productoId = productos.id";
        $query .= " WHERE pedidos.id = $id;";

        $pedidos = PedidoProducto::SQL($query);

        $router->render('pedidos/pedido', [
            'pedidos' => $pedidos
        ]);
    }

    public static function crear(Router $router) {
        $pedido = new Pedido;

        $clientes = Cliente::all();

        $router->render('admin/pedidos/crear', [
            'clientes' => $clientes,
            'pedido' => $pedido
        ]);
    }
}