<?php

namespace Models;

class ReporteVacaciones  extends ActiveRecord{
    protected static $tabla = 'solicitud_vacaciones';
    protected static $columnasDB = ['nombre','fecha_solicitud_vacaciones','estatus','usuario_id',
                'id_solicitudes_vacaciones'];

    public $nombre;
    public $fecha_solicitud_vacaciones;
    public $estatus;
    public $usuario_id;
    public $id_solicitudes_vacaciones;

    public function __construct($args = []){
        $this->nombre = $args['nombre'];
        $this->fecha_solicitud_vacaciones= $args['fecha_solicitud_vacaciones'];
        $this->estatus = $args['estatus'];
        $this->usuario_id = $args['usuario_id'];
        $this->id_solicitudes_vacaciones= $args['id_solicitudes_vacaciones'];
    }
}