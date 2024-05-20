<?php
namespace Model;

class Pedido extends ActiveRecord {
    protected static $tabla = 'pedidos';
    protected static $columnasDB = ['id', 'fecha', 'clienteId', 'estado', 'total'];

    public $id;
    public $fecha;
    public $clienteId;
    public $nombre;
    public $estado;
    public $total;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->fecha = $args['fecha'] ?? date('Y-m-d');
        $this->clienteId = $args['clienteId'] ?? '';
        $this->nombre = $args['nombre'] ?? '';
        $this->estado = $args['estado'] ?? 'credito';
        $this->total = $args['total'] ?? 'credito';
    }

    public function validar() {
        if(!$this->nombre) {
            self::$alertas['error'][] = 'El Nombre del cliente es Obligatorio';
        }
        if(!$this->fecha) {
            self::$alertas['error'][] = 'La Fecha del Pedido es Obligatoria';
        }

        return self::$alertas;
    }
}