<?php 


namespace Controllers;
require_once("../classes/fpdf.php");

use FPDF;
use Models\ReportesPermisos;
use MVC\Router;



class ReportesController{
    public static function index(Router $router){
        session_start();
        isAuth();
        
        $router->render('reportes/index',[
            'nombre' => $_SESSION['nombre'],
            'id_usuario' =>$_SESSION['id'] ,
        ]);
    }

    public static function generarReportes(Router $router){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Recoger las fechas enviadas desde el formulario
            $fechaInicio = $_POST['fechaInicio'] ?? '';
            $fechaFin = $_POST['fechaFin'] ?? '';
            //SQL para la consulta de la base de datos
            $consulta = "SELECT u.nombre as nombre, ";
            $consulta .= "sp.idsolicitud_permiso,s.usuario_id, ";
            $consulta .= "sp.fecha_solicitud, sp.estatus ";
            $consulta .= "FROM solicitud_permiso sp ";
            $consulta .= "JOIN solicitudes s ON sp.idsolicitud_permiso = s.id_solicitud_permiso ";
            $consulta .= "JOIN usuarios u ON s.usuario_id = u.id ";
            $consulta .= "WHERE sp.fecha_solicitud BETWEEN '$fechaInicio' AND '$fechaFin' AND sp.estatus = 1";
            $reporteOne = ReportesPermisos::SQL($consulta);
            //pdf
            // Crear una instancia de FPDF
            $pdf = new FPDF();
            $pdf->AddPage();
            $pdf->SetFont('Arial', 'B', 16);
            $pdf->Cell(0, 10, 'Reporte de Permisos Pendientes', 0, 1, 'C');

            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(40, 10, 'Nombre', 1);
            $pdf->Cell(50, 10, 'Fecha Solicitud', 1);
            //$pdf->Cell(30, 10, 'Estatus', 1);
            $pdf->Cell(40, 10, 'Usuario ID', 1);
            $pdf->Cell(50, 10, 'ID Solicitud', 1);
            $pdf->Ln();

            // Contenido de la tabla
            $pdf->SetFont('Arial', '', 12);
            foreach ($reporteOne as $reporte) {
                $pdf->Cell(40, 10, $reporte->nombre, 1);
                $pdf->Cell(50, 10, $reporte->fecha_solicitud, 1);
                //$pdf->Cell(30, 10, $reporte->estatus, 1);
                $pdf->Cell(40, 10, $reporte->usuario_id, 1);
                $pdf->Cell(50, 10, $reporte->idsolicitud_permiso, 1);
                $pdf->Ln();
            }

            // Salida del PDF
            $pdf->Output('I', 'reporte_permisos_pendiente.pdf'); // Descarga el PDF generado



            //Router
            $router->render('/reportes/generar',[
                'nombre' => $_SESSION['nombre'],
                'id_usuario' =>$_SESSION['id'] ,
                'reporteOne'=>$reporteOne
            ]);
        }
    }
}