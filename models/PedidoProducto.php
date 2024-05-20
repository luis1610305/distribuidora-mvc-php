<?php
namespace Model;

class PedidoProducto extends ActiveRecord {
    protected static $tabla = 'pedidoProducto';
    protected static $columnasDB = ['id', 'pedidoId', 'productoId', 'cantidad', 'peso'];

    public $id;
    public $pedidoId;
    public $productoId;
    public $cantidad;
    public $peso;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->pedidoId = $args['pedidoId'] ?? '';
        $this->productoId = $args['productoId'] ?? '';
        $this->cantidad = $args['cantidad'] ?? '';
        $this->peso = $args['peso'] ?? '';
    }
}