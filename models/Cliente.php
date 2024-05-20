<?php
namespace Model;

use Model\ActiveRecord;

class Cliente extends ActiveRecord {
    protected static $tabla = 'clientes';
    protected static $columnasDB = ['id', 'nombre', 'correo', 'telefono', 'direccion', 'distritoId'];

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->correo = $args['correo'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->direccion = $args['direccion'] ?? '';
        $this->distritoId = $args['distritoId'] ?? '';
        $this->distrito = $args['distrito'] ?? '';
    }

    public function validarCliente() {
        if(!$this->nombre) {
            self::$alertas['error'][] = 'El Nombre del cliente es Obligatorio';
        }
        if(!$this->distritoId) {
            self::$alertas['error'][] = 'El Distrito del cliente es Obligatorio';
        }

        return self::$alertas;
    }
}