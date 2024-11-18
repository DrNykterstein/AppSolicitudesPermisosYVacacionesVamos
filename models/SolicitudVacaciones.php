<?php 

namespace Models;

class SolicitudVacaciones extends ActiveRecord{
    //Configuracion de la base de datos
    protected static $tabla = 'solicitud_vacaciones';
    protected static $columnasDB = ['id_solicitudes_vacaciones','fecha_solicitud_vacaciones',
                    'estatus','fecha_inicio_vacaciones','fecha_fin_vacaciones'];

    public $id_solicitudes_vacaciones;
    public $fecha_solicitud_vacaciones;
    public $estatus;
    public $fecha_inicio_vacaciones;
    public $fecha_fin_vacaciones;

    public function __construct($args = []){
        $this->id_solicitudes_vacaciones = $args['id_solicitudes_vacaciones'];
        $this->fecha_solicitud_vacaciones = $args['fecha_solicitud_vacaciones'] ?? null;
        $this->estatus = $args['estatus'] ?? 1;
        $this->fecha_inicio_vacaciones = $args['fecha_inicio_vacaciones'] ?? null;
        $this->fecha_fin_vacaciones = $args['fecha_fin_vacaciones'] ?? null;
    }
}