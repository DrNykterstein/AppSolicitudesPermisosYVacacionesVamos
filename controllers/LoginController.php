<?php

//Llamo al Namespace del controlador
namespace Controllers;

use Classes\Email;
use Models\Usuario;
use MVC\Router;

//Clase del login (inicio de sesion)
class LoginController{
    //Para iniciar sesion
    public static function login(Router $router){
        $alertas = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new Usuario($_POST);
            $alertas = $auth->validarLogin();
            //Si no hay alertas, valido el inicio de sesion
            if(empty($alertas)){
                //verifico que el correo exista
                $usuario = new Usuario();
                $usuario = Usuario::where('email', $auth->email);
                //debuguear($usuario);
                $passwordBD = trim($usuario->password);//Contraseñada hasheada de la base de datos
                $passUser = trim($auth->password);//Contraseña colocada en el formulario
                if($usuario){
                    $resultado = password_verify($passUser,$passwordBD);//Comparacion
                    if(!$resultado or !$usuario->confirmado){
                        $alertas['error'][] = 'Contraseña Incorrecta o no estas confirmado Compadre';
                    }else{
                        //autentica al usuario
                        session_start();
                        $_SESSION['id']=$usuario->id;
                        $_SESSION['nombre']=$usuario->nombre." ".$usuario->apellido;
                        $_SESSION['email']=$usuario->email;
                        $_SESSION['login']=true;
                        //redireccionar segun el perfil del usuario
                        if($usuario->codigo_perfil === "1"){
                            $_SESSION['codigo_perfil'] = $usuario->codigo_perfil ?? null;
                            header('Location: /admin');
                        }else{
                            header('Location: /solicitudPermiso');
                        }
                    }
                }else{
                    $alertas['error'][] = 'El  correo no esta registrado compadre'; 
                }
            }
        }
        //paso las alertas a la vista
        $router->render('auth/login',[
            'alertas' => $alertas
        ]); 
    }
    //Cierre de sesion
    public static function logout(){
        session_start();
        $_SESSION = [];
        header('Location: /');
    }
    //Recuperar password
    public static function olvide(Router $router){
        $alertas = [];
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $auth = new Usuario($_POST);
            $alertas = $auth->validarEmail();
            if(empty($alertas)){
                $usuario = new Usuario();
                $usuario = Usuario::where('email',$auth->email);
                if($usuario and $usuario->confirmado === '1'){
                    //Genero un token para que el usuario pueda recuperar su usuario
                    $usuario->crearToken();
                    $usuario->guardar();
                    //envio el email
                    $email = new Email($usuario->email,$usuario->nombre,$usuario->token);
                    $email->enviarInstrucciones();
                    //Muestro la alerta de exito
                    $alertas['exito'][] = 'Las instrucciones para recuperar la contraseña han sido enviadas';
                }else{
                    $alertas['error'][] = 'El correo no existe o no esta confirmado Compadre';
                }
            }
        }
        $router->render('auth/olvidePassword',[
            'alertas' => $alertas
        ]);
    }
    public static function recuperar(Router $router){
        //Array vacio de las alertas de exito o error
        $alertas = [];
        $error = false;
        $token = s($_GET['token']);
        //busco al usuario en la base de datos
        $usuario = new Usuario;
        $usuario = Usuario::where('token',$token);
        //Si el token no existe
        if(empty($usuario)){
            //Se muestra el error del TOKEN no valido
            $alertas['error'][] = 'TOKEN NO VALIDO COMPADRE';
            $error = true;
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            //se lee la nueva contraseña
            $password = new Usuario($_POST);
            $alertas = $password->validarPassword();
            if(empty($alertas)){
                $usuario->password = null;
                $usuario->password = $password->password;
                $usuario->hashPassword();
                $usuario->token=null;
                $resultado = $usuario->guardar();
                if($resultado){
                    header('Location: /');
                }
            }
        }
        //debuguear($usuario);
           

        $router->render('auth/recuperarPassword',[
            'alertas'=>$alertas,
            'error'=>$error
        ]);

    }
    //crear la cuenta
    public static function crearCuenta(Router $router){
        //Creo la instancia del usuario
        $usuario = new Usuario;
        //Creo un arreglo para las alertas
        $alertas = [];
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validaNuevaCuenta();
            //reviso que alertas este vacio, para validar
            if(empty($alertas)){
                //Se verifica que el usuario no este registrado, tanto por correo como por cedula
                $resultado = $usuario->existeUsuario();
                $resultadoCedula = $usuario->existeCedula();
                if(($resultado->num_rows) or ($resultadoCedula->num_rows)){
                    $alertas = Usuario::getAlertas();
                }else{
                    //No esta registrado
                    //Llamo a la funcion del Hash a la contraseña
                    $usuario->hashPassword();
                    //Genero el token de la validacion
                    $usuario->crearToken();
                    //Declaro la instancia del objeto email
                    $email = new Email($usuario->nombre,$usuario->email,$usuario->token);
                    //Envio el email
                    $email->enviarConfirmacion();
                    //crea el usuario
                    $resultado = $usuario->guardar();
                    if($resultado){
                        header('Location: /mensaje');
                    }  
                }
            }
        }
        $router->render('auth/crearCuenta',[
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }

    public static function mensaje(Router $router){
        $router->render('auth/mensaje');
    }

    public static function confirmar(Router $router){
        $alertas=[];
        $token=s($_GET['token']);
        $usuario = Usuario::where('token',$token);
        if(empty($usuario)){
            //si esta vacio, se muestra mensaje de error
            $alertas['error'][] = 'La cuenta no ha sido confirmada Confirmada';
        }else{
            //Modifico el confirmado a 1
            $usuario->confirmado="1";
            $usuario->token=null;
            $usuario->guardar();
            //Muestro mensaje de exito
            $alertas['exito'][] = 'Compadre la cuenta ha sido confirmada';
        }
        //Se renderiza la vista
        $router->render('auth/confirmarCuenta',[
            'alertas' => $alertas
        ]); 
    }
}