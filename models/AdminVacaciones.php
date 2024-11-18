<?php

namespace Models;

class AdminVacaciones extends ActiveRecord{
    protected static $tabla = 'solicitud_vacaciones';
    protected static $columnasDB = ['nombre','id_solicitud_vacaciones','fecha_solicitud_vacaciones'
                ,'estatus','fecha_inicio_vacaciones','fecha_fin_vacaciones','tipo_solicitud'];

    public $nombre;
    public $id_solicitud_vacaciones;
    public $fecha_solicitud_vacaciones;
    public $estatus;
    public $fecha_inicio_vacaciones;
    public $fecha_fin_vacaciones;
    public $tipo_solicitud;

    public function __construct($args = []){
        $this->nombre = $args['nombre'];
        $this->id_solicitud_vacaciones = $args['id_solicitud_vacaciones'];
        $this->fecha_solicitud_vacaciones = $args['fecha_solicitud_vacaciones'];
        $this->estatus = $args['estatus'];
        $this->fecha_inicio_vacaciones = $args['fecha_inicio_vacaciones'];
        $this->fecha_fin_vacaciones = $args['fecha_fin_vacaciones'];
        $this->tipo_solicitud = $args['tipo_solicitud'];
    }
}