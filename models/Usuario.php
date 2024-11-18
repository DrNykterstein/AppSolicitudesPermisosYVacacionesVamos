<?php 

namespace Models;

class Usuario extends ActiveRecord{
    // Base de datos
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id','cedula','nombre','apellido','antiguedad','email',
                                    'telefono','codigo_perfil','confirmado','token',
                                    'password'];

    public $id;
    public $cedula;
    public $nombre;
    public $apellido;
    public $antiguedad;
    public $email;
    public $telefono;
    public $codigo_perfil;
    public $confirmado;
    public $token;
    public $password;

    //Constructor
    public function __construct($args=[]){
        //Procedo a instanciar mis objetos
        $this->id=$args['id'] ?? null;
        $this->cedula=$args['cedula'] ?? '';
        $this->nombre=$args['nombre'] ?? '';
        $this->apellido=$args['apellido'] ?? '';
        $this->antiguedad=$args['antiguedad'] ?? '';
        $this->email=$args['email'] ?? '';
        $this->telefono=$args['telefono'] ?? '';
        $this->codigo_perfil=$args['codigo_perfil'] ?? '0';
        $this->confirmado=$args['confirmado'] ?? '0';
        $this->token=$args['token'] ?? '';
        $this->password=$args['password'] ?? '';
    }

    //Validaciones para la creacion del usuario
    public function validaNuevaCuenta(){
        //En caso de que el campo de nombre este vacio
        if(!$this->nombre){
            self::$alertas['error'][] = 'El nombre es obligatorio compadre';
        }

        //Apellido    
        if(!$this->apellido){
            self::$alertas['error'][]= 'El Apellido es obligatorio compadre';
        }

        //Cedula
        if(!$this->cedula){
            self::$alertas['error'][] = 'La cedula es obligatoria compadre';
        }
        //antiguedad
        if(!$this->antiguedad){
            self::$alertas['error'][] = 'Tu antiguedad es importante compadre, colocala';
        }
        //email
        if(!$this->email){
            self::$alertas['error'][] = 'El correo es obligatorio compadre';
        }
        //telefono
        if(!$this->telefono){
            self::$alertas['error'][] = 'El telefono es obligatorio compadre';
        }
        //contraseña
        if(!$this->password){
            self::$alertas['error'][] = 'Por favor escribe una contraseña compadre';
        }
        if(strlen($this->password) < 7){
            self::$alertas['error'][] = 'La contraseña debe tener al menos 7 caracteres, compadre';
        }
        return self::$alertas;
    }

    //metodo para validar el inicio de sesion
    public function validarLogin(){
        if(!$this->email){
            self::$alertas['error'][] = '¿Que paso Compadre?, debes colocar el Correo Coorporativo';
        }
        if(!$this->password){
            self::$alertas['error'][] = 'La contraseña no puede estar vacia compadre';
        }
        return self::$alertas;
    }

    //Metodo para Validar el correo Electronico
    public function validarEmail(){
        if(!$this->email){
            self::$alertas['error'][] = 'Ese correo no existe Compadre';
        }
        return self::$alertas;
    }

    //Metodo para Validar una contraseña
    public function validarPassword(){
        if(!$this->password){
            self::$alertas['error'][] = 'La Contraseña es obligatoria Compadre';
        }
        if(strlen($this->password)< 7){
            self::$alertas['error'][] = 'La Contraseña debe tener al menos 7 caracteres compadre';
        }
        return self::$alertas;
    }

    //Metodo para validar si el usuario esta registrado o no 
    public function existeUsuario(){
        $query = "SELECT * FROM ".self::$tabla." WHERE email= '".$this->email."' LIMIT 1 ";
        $resultado = self::$db->query($query);
        //si consigue un correo , quiere decir que el usuario ya esta registrado
        if($resultado->num_rows){
            self::$alertas['error'][] = 'El usuario ya esta registrado, compadre';
        }
        return $resultado;
    }

    //Metodo para verificar si la cedula esta registrada o no
    public function existeCedula(){
        $query = "SELECT * FROM ".self::$tabla." WHERE cedula= '".$this->cedula."' LIMIT 1 ";
        $resultado = self::$db->query($query);
        //si consigue un correo , quiere decir que el usuario ya esta registrado
        if($resultado->num_rows){
            self::$alertas['error'][] = 'La cedula ya esta registrada compadre';
        }
        return $resultado;
    }

    //Metodo de Hash al password
    public function hashPassword(){
        $this->password = trim($this->password);
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        
    }

    //Metodo para generar un token
    public function crearToken(){
        $this->token = uniqid();
    }
    
}