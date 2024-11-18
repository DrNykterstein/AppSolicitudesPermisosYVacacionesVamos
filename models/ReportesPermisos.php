<?php

namespace Models;

class ReportesPermisos extends ActiveRecord{
    protected static $tabla = 'solicitud_permiso';
    protected static $columnasDB = ['nombre','fecha_solicitud','estatus','usuario_id',
                'idsolicitud_permiso'];

    public $nombre;
    public $fecha_solicitud;
    public $estatus;
    public $usuario_id;
    public $idsolicitud_permiso;

    public function __construct($args = []){
        $this->nombre = $args['nombre'];
        $this->fecha_solicitud= $args['fecha_solicitud'];
        $this->estatus = $args['estatus'];
        $this->usuario_id = $args['usuario_id'];
        $this->idsolicitud_permiso= $args['idsolicitud_permiso'];
    }
}