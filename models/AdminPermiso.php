<?php

namespace Models;

class AdminPermiso extends ActiveRecord{
    protected static $tabla = 'solicitud_permiso';
    protected static $columnasDB = ['nombre','id_solicitud_permiso','fecha_inicio','duracion_permiso'
                                ,'fecha_culminacion','tipo_solicitud','estatus'];
    public $nombre;
    public $id_solicitud_permiso;
    public $fecha_inicio;
    public $duracion_permiso;
    public $fecha_culminacion;
    public $tipo_solicitud;
    public $estatus;

    public function __construct($args = []){
        $this->nombre = $args['nombre'];
        $this->id_solicitud_permiso = $args['id_solicitud_permiso'];
        $this->fecha_inicio = $args['fecha_inicio'];
        $this->duracion_permiso = $args['duracion_permiso'];
        $this->fecha_culminacion = $args['fecha_culminacion'];
        $this->tipo_solicitud = $args['tipo_solicitud'];
        $this->estatus = $args['estatus'];
    }
}