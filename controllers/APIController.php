<?php 

namespace Controllers;

use Models\Motivos;
use Models\Solicitudes;
use Models\SolicitudesV;
use Models\SolicitudPermiso;
use Models\SolicitudVacaciones;
use Classes\Email;
use MVC\Router;

class APIController{
    public static function index(){
        $motivos = Motivos::all();
        echo json_encode($motivos);
    }
    //Metodo para registrar la solicitud de permiso
    public static function guadarPermiso(){
        $solicitudPermiso = new SolicitudPermiso($_POST);
        $solicitudes = new Solicitudes($_POST);
        $resultado = $solicitudPermiso->guardar();
        $resultado2 = $solicitudes->guardar();

        echo json_encode($resultado);
    }

    //Metodo para registrar la solicitud de vacaciones
    public static function guadarVacaciones(){
        $solicitudVacaciones = new SolicitudVacaciones($_POST);
        $solicitudesV = new SolicitudesV($_POST);
        $resultadoVacaciones = $solicitudVacaciones->guardar();
        $solicitudesV3 = $solicitudesV->guardar();
        echo json_encode($resultadoVacaciones);

    }

    public static function aprobarPermisos(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $idPermiso = $_POST['idPermiso'];
            $permiso = SolicitudPermiso::findPermiso($idPermiso);
            $permiso->updatePermiso($idPermiso);
            $correo="cuenta@cuenta.com";
            $nombre="";
            $token="";
            $email = new Email($correo,$nombre,$token);
            $email->enviarPermiso();
            header('Location: '.$_SERVER['HTTP_REFERER']);
        }
    }

    public static function rechazarPermisos(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $idPermiso = $_POST['idPermiso'];
            $permiso = SolicitudPermiso::findPermiso($idPermiso);
            $permiso->rechazarPermiso($idPermiso);
            header('Location: '.$_SERVER['HTTP_REFERER']);
    }
    }
}