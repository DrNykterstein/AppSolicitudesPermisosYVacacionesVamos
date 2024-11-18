<?php


namespace Controllers;

use Models\AdminPermiso;
use MVC\Router;

class AdminController{
    public static function index(Router $router){
        session_start();
        isAdmin();
        $fecha = $_GET['fecha'] ?? date('Y-m-d');
        //Consultar la base de datos
        $consulta = "SELECT concat(u.nombre,' ',u.apellido) as nombre, ";
        $consulta .= "s.id_solicitud_permiso,sp.fecha_inicio,sp.duracion_permiso,sp.estatus, ";
        $consulta .= "sp.fecha_culminacion,s.tipo_solicitud ";
        $consulta .= "FROM solicitudes s ";
        $consulta .= "JOIN solicitud_permiso sp ON s.id_solicitud_permiso = sp.idsolicitud_permiso ";
        $consulta .= "JOIN usuarios u ON s.usuario_id = u.id ";
        $consulta .= "WHERE sp.fecha_solicitud = '$fecha'"; 
        $permisos =  AdminPermiso::SQL($consulta);
    
        $router->render('admin/index',[
            'nombre' => $_SESSION['nombre'],
            'permisos' => $permisos,
            'fecha' => $fecha
        ]);
    }
 }