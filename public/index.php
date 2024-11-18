<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\AdminController;
use Controllers\APIController;
use Controllers\LoginController;
use Controllers\PermisoController;
use Controllers\VacacionesController;
use Controllers\ReportesController;
use Controllers\ReportesControllerV;
use Controllers\ReportesControllerPa;
use MVC\Router;

$router = new Router();


//Mis rutas

//Iniciar sesion
$router->get('/',[LoginController::class, 'login']);
$router->post('/',[LoginController::class, 'login']);
//cerrar sesion
$router->get('/logout',[LoginController::class, 'logout']);
//Recuperar password
$router->get('/olvide',[LoginController::class, 'olvide']);
$router->post('/olvide',[LoginController::class, 'olvide']);
$router->get('/recuperar',[LoginController::class, 'recuperar']);
$router->post('/recuperar',[LoginController::class, 'recuperar']);

//crear cuentas de usuario
$router->get('/crearCuenta',[LoginController::class, 'crearCuenta']);
$router->post('/crearCuenta',[LoginController::class, 'crearCuenta']);

//Confirmar cuentas
$router->get('/confirmar-cuenta',[LoginController::class, 'confirmar']);
$router->get('/mensaje',[LoginController::class, 'mensaje']);

//Area Privada
$router->get('/solicitudPermiso',[PermisoController::class,'index']);
$router->get('/admin',[AdminController::class,'index']);
//Api de permisos
$router->get('/api/motivos',[APIController::class,'index']);
$router->post('/api/permisos',[APIController::class,'guadarPermiso']);
$router->post('/api/vacaciones',[APIController::class,'guadarVacaciones']);

$router->post('/api/aprobarPermisos',[APIController::class,'aprobarPermisos']);
$router->post('/api/rechazarPermisos',[APIController::class,'rechazarPermisos']);
$router->get('/vacaciones',[VacacionesController::class,'index']);
$router->post('/vacaciones',[VacacionesController::class,'aprobarVacaciones']);
$router->post('/vacaciones/rechazarVacaciones',[VacacionesController::class,'rechazarVacaciones']);
$router->get('/reportes',[ReportesController::class,'index']);
$router->post('/reportes/generar',[ReportesController::class,'generarReportes']);
$router->get('/reporteV',[ReportesControllerV::class,'index']);
$router->post('/reporteV/generarv',[ReportesControllerV::class,'generarReportesVacaciones']);
$router->get('/reportePA',[ReportesControllerPa::class,'index']);
$router->post('/reportePA/generarPa',[ReportesControllerPa::class,'generarPermisosAprobados']);
// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();