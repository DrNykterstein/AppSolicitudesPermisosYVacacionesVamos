<?php 

namespace Models;


class Solicitudes extends ActiveRecord{
    // Base de datos de solicitud permiso
    protected static $tabla = 'solicitudes';
    protected static $columnasDB = ['id_solicitud_permiso'
                    ,'usuario_id','tipo_solicitud'];

   
    public $id_solicitud_permiso;
    public $usuario_id;
    public $tipo_solicitud;

    public function __construct($args = []){
        $this->id_solicitud_permiso = $args['idsolicitud_permiso'];
        //$this->id_solicitud_vacaciones = $args['id_solicitud_vacaciones'];
        $this->usuario_id = $args['id_usuario'] ?? '0';
        $this->tipo_solicitud = $args['tipo_solicitud'] ?? 'P';
    }



}