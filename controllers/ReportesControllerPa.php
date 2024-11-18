<?php 


namespace Controllers;
require_once("../classes/fpdf.php");

use FPDF;
use Models\ReportePermisosAprobados;
use MVC\Router;

class ReportesControllerPa {
    public static function index(Router $router){
        session_start();
        isAuth();
        
        $router->render('reportePa/index',[
            'nombre' => $_SESSION['nombre'],
            'id_usuario' =>$_SESSION['id'] ,
        ]);
    }

    public static function generarPermisosAprobados(Router $router){
        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            $fechaInicio = $_POST['fechaInicio'] ?? '';
            $fechaFin = $_POST['fechaFin'] ?? '';
            //Consulta
            $consulta = "SELECT u.nombre as nombre, ";
            $consulta .= "sp.idsolicitud_permiso,s.usuario_id, ";
            $consulta .= "sp.fecha_solicitud, sp.estatus ";
            $consulta .= "FROM solicitud_permiso sp ";
            $consulta .= "JOIN solicitudes s ON sp.idsolicitud_permiso = s.id_solicitud_permiso ";
            $consulta .= "JOIN usuarios u ON s.usuario_id = u.id ";
            $consulta .= "WHERE sp.fecha_solicitud BETWEEN '$fechaInicio' AND '$fechaFin' AND sp.estatus = 0";
            $reportePa = ReportePermisosAprobados::SQL($consulta);
            //debuguear($reportePa);
            //hago el reporte
            $pdf = new FPDF();
            $pdf->AddPage();
            $pdf->SetFont('Arial', 'B', 16);
            $pdf->Cell(0, 10, 'Reporte de Permisos Aprobados', 0, 1, 'C');

            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(40, 10, 'Nombre', 1);
            $pdf->Cell(50, 10, 'Fecha Solicitud', 1);
            //$pdf->Cell(30, 10, 'Estatus', 1);
            $pdf->Cell(40, 10, 'Usuario ID', 1);
            $pdf->Cell(50, 10, 'ID Solicitud', 1);
            $pdf->Ln();

            // Contenido de la tabla
            $pdf->SetFont('Arial', '', 12);
            foreach ($reportePa as $reporte) {
                $pdf->Cell(40, 10, $reporte->nombre, 1);
                $pdf->Cell(50, 10, $reporte->fecha_solicitud, 1);
                //$pdf->Cell(30, 10, $reporte->estatus, 1);
                $pdf->Cell(40, 10, $reporte->usuario_id, 1);
                $pdf->Cell(50, 10, $reporte->idsolicitud_permiso, 1);
                $pdf->Ln();
            }

            // Salida del PDF
            $pdf->Output('I', 'reporte_vacaciones_pendiente.pdf');

        }
    }
}