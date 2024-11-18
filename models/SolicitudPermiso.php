<?php 

namespace Models;

class SolicitudPermiso extends ActiveRecord{
    // Base de datos de solicitud permiso
    protected static $tabla = 'solicitud_permiso';
    protected static $columnasDB = ['idsolicitud_permiso','fecha_solicitud',
                    'duracion_permiso','fecha_inicio','fecha_culminacion',
                    'id_motivo','estatus'];

    public $idsolicitud_permiso;
    public $fecha_solicitud;
    public $duracion_permiso;
    public $fecha_inicio;
    public $fecha_culminacion;
    public $id_motivo;
    public $estatus;

    public function __construct($args = []){
        $this->idsolicitud_permiso = $args['idsolicitud_permiso'] ?? '0';
        $this->fecha_solicitud = $args['fecha_solicitud'] ?? '';
        $this->duracion_permiso = $args['duracion_permiso'] ?? '';
        $this->fecha_inicio = $args['fecha_inicio'] ?? '';
        $this->fecha_culminacion = $args['fecha_culminacion'] ?? '';
        $this->id_motivo = $args['id_motivo'];
        $this->estatus = $args['estatus'] ?? 1;

    }

}