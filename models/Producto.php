<?php
namespace Model;

use Model\ActiveRecord;

class Producto extends ActiveRecord {
   protected static $tabla = 'productos';
   protected static $columnasDB = ['id', 'codigo', 'descripcion', 'precio'];
   
   public $id;
   public $codigo;
   public $descripcion;
   public $precio;

   public function __construct($args = [])
   {
        $this->id = $args['id'] ?? null;
        $this->codigo = $args['codigo'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->precio = $args['precio'] ?? '';
   }

   public function validar() {
    if(!$this->codigo) {
        self::$alertas['error'][] = 'El codigo del producto es obligatorio';
    }
    if(!$this->descripcion) {
        self::$alertas['error'][] = 'La descripcion del producto es obligatorio';
    }
    if(!$this->precio) {
        self::$alertas['error'][] = 'El precio del producto es obligatorio';
    }

    return self::$alertas;
   }
}
