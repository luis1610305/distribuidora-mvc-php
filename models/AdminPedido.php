<?php
namespace Model;

class AdminPedido extends ActiveRecord {
    protected static $tabla = 'pedidoProducto';
    protected static $columnasDB = ['id', 'fecha', 'cliente', 'producto', 'cantidad', 'peso', 'precio'];

    public $id;
    public $fecha;
    public $cliente;
    public $producto;
    public $cantidad;
    public $peso;
    public $precio;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->hora = $args['hora'] ?? '';
        $this->cliente = $args['cliente'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->servicio = $args['servicio'] ?? '';
        $this->precio = $args['precio'] ?? '';
    }
}