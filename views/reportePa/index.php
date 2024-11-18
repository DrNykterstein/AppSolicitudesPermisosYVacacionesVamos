<h1 class="nombre-pagina">Gestion de Permisos y de Vacaciones</h1>
<p class="descripcion-pagina">Reporte de Permisos Aprobados</p>

<?php
    include_once __DIR__.'/../templates/barra.php';
?>

<h2>Selecciona un rango de fecha</h2>
<div class="busqueda">
    <form class="formulario" action="/reportePA/generarPa" method="POST">
        <div class="campo">
            <label for="fechaInicio">Fecha Inicio</label>
            <input 
                type="date"
                id="fechaInicio"
                name="fechaInicio"
                value="<?php echo $fecha;?>"
            />
        </div>
        <div class="campo">
            <label for="fechaFin">Fecha Fin</label>
            <input 
                type="date"
                id="fechaFin"
                name="fechaFin"
                value="<?php echo $fecha;?>"
            />
        </div>
        <input type="submit" class="boton-aprobar boton" value="Ver Reporte">
    </form>
</div>

<?php
    $script = "<script src='build/js/buscador.js'></script>"

?>