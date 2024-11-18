<?php 


namespace Controllers;
require_once("../classes/fpdf.php");

use FPDF;
use Models\ReporteVacaciones;
use MVC\Router;

class ReportesControllerV{
    public static function index(Router $router){
        session_start();
        isAuth();
        
        $router->render('reportesV/index',[
            'nombre' => $_SESSION['nombre'],
            'id_usuario' =>$_SESSION['id'] ,
        ]);
    }

    public static function generarReportesVacaciones(Router $router){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Recoger las fechas enviadas desde el formulario
            $fechaInicio = $_POST['fechaInicio'] ?? '';
            $fechaFin = $_POST['fechaFin'] ?? '';
            //SQL para la consulta de la base de datos
            //SQL para la consulta de la base de datos
            $consulta = "SELECT u.nombre as nombre, ";
            $consulta .= "sv.id_solicitudes_vacaciones,s.usuario_id, ";
            $consulta .= "sv.fecha_solicitud_vacaciones, sv.estatus ";
            $consulta .= "FROM solicitud_vacaciones sv ";
            $consulta .= "JOIN solicitudes s ON sv.id_solicitudes_vacaciones = s.id_solicitud_vacaciones ";
            $consulta .= "JOIN usuarios u ON s.usuario_id = u.id ";
            $consulta .= "WHERE sv.fecha_solicitud_vacaciones BETWEEN '$fechaInicio' AND '$fechaFin' AND sv.estatus = 1";
            $reporteVac = ReporteVacaciones::SQL($consulta);
            //debuguear($reporteVac);
            //pdf
            $pdf = new FPDF();
            $pdf->AddPage();
            $pdf->SetFont('Arial', 'B', 16);
            $pdf->Cell(0, 10, 'Reporte de Vacaciones Pendientes', 0, 1, 'C');

            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(40, 10, 'Nombre', 1);
            $pdf->Cell(50, 10, 'Fecha Solicitud', 1);
            //$pdf->Cell(30, 10, 'Estatus', 1);
            $pdf->Cell(40, 10, 'Usuario ID', 1);
            $pdf->Cell(50, 10, 'ID Solicitud', 1);
            $pdf->Ln();

            // Contenido de la tabla
            $pdf->SetFont('Arial', '', 12);
            foreach ($reporteVac as $reporte) {
                $pdf->Cell(40, 10, $reporte->nombre, 1);
                $pdf->Cell(50, 10, $reporte->fecha_solicitud_vacaciones, 1);
                //$pdf->Cell(30, 10, $reporte->estatus, 1);
                $pdf->Cell(40, 10, $reporte->usuario_id, 1);
                $pdf->Cell(50, 10, $reporte->id_solicitudes_vacaciones, 1);
                $pdf->Ln();
            }

            // Salida del PDF
            $pdf->Output('I', 'reporte_vacaciones_pendiente.pdf');


            $router->render('/reporteV/generarv',[
                'nombre' => $_SESSION['nombre'],
                'id_usuario' =>$_SESSION['id'] ,
                'reporteVac'=>$reporteVac
            ]);
        }
        }
}