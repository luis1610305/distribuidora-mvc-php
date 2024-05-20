<?php
namespace Model;

use Model\ActiveRecord;

class Distrito extends ActiveRecord {
    protected static $tabla = 'distritos';
    protected static $columnasDB = ['id', 'distrito'];

    public $id;
    public $distrito;
}