<?php


namespace Controllers;

use Models\AdminVacaciones;
use MVC\Router;

class VacacionesController{
    public static function index(Router $router){
        session_start();
        $fecha = $_GET['fecha'] ?? date('Y-m-d');
        //Consulta de base de datos
        $consulta = "SELECT concat(u.nombre,' ',u.apellido) as nombre, ";
        $consulta .= "s.id_solicitud_vacaciones, sv.fecha_inicio_vacaciones, sv.estatus, ";
        $consulta .= "sv.fecha_fin_vacaciones,s.tipo_solicitud ";
        $consulta .= "FROM solicitudes s ";
        $consulta .= "JOIN solicitud_vacaciones sv on s.id_solicitud_vacaciones = sv.id_solicitudes_vacaciones  ";
        $consulta .= "JOIN usuarios u ON s.usuario_id = u.id ";
        $consulta .= "WHERE sv.fecha_solicitud_vacaciones = '$fecha'";
        $vacaciones = AdminVacaciones::SQL($consulta);
        $router->render('vacaciones/index',[
            'nombre' => $_SESSION['nombre'],
            'fecha' => $fecha,
            'vacaciones'=>$vacaciones
        ]);
    }
    public static function aprobarVacaciones(){
        if($_SERVER['REQUEST_METHOD']==='POST'){
            $idVacaciones = $_POST['idVacaciones'];
            $solicitudVac = AdminVacaciones::findVacaciones($idVacaciones);
            $solicitudVac->updateVacaciones($idVacaciones);
            header('Location: '.$_SERVER['HTTP_REFERER']);
            
        }
    }

    public static function rechazarVacaciones(){
        if($_SERVER['REQUEST_METHOD']==='POST'){
            $idVacaciones = $_POST['idVacaciones'];
            $solicitudVac = AdminVacaciones::findVacaciones($idVacaciones);
            $solicitudVac->rechazarVacaciones($idVacaciones);
            header('Location: '.$_SERVER['HTTP_REFERER']);
            
        }
    }



}