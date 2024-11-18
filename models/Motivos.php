<?php 

namespace Models;

class Motivos extends ActiveRecord{
    //Base de datos 
    protected static $tabla = 'motivos';
    protected static $columnasDB = ['idmotivos','nombre'];

    public $idmotivos;
    public $nombre;

    public function __construct($args = []){
        $this->idmotivos=$args['idmotivos'] ?? null;
        $this->nombre=$args['nombre'] ?? null;
    }
}