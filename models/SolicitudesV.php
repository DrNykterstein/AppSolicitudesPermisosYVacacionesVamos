<?php 

namespace Models;


class SolicitudesV extends ActiveRecord{
    // Base de datos de solicituudes
    protected static $tabla = 'solicitudes';
    protected static $columnasDB = ['id_solicitud_vacaciones'
                    ,'usuario_id','tipo_solicitud'];

   
    public $id_solicitud_vacaciones;
    public $usuario_id;
    public $tipo_solicitud;

    public function __construct($args = []){
        $this->id_solicitud_vacaciones = $args['id_solicitudes_vacaciones'];
        //$this->id_solicitud_vacaciones = $args['id_solicitud_vacaciones'];
        $this->usuario_id = $args['id_usuario'] ?? '0';
        $this->tipo_solicitud = $args['tipo_solicitud'] ?? 'V';
    }



}