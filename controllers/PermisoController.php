<?php 

namespace Controllers;
use MVC\Router;

class PermisoController{
    public static function index(Router $router){
        session_start();
        isAuth();

        $router->render('permiso/index',[
            'nombre' => $_SESSION['nombre'],
            'id_usuario' =>$_SESSION['id'] 
        ]);
    }
}