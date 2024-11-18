<div class="barra">
    <p>Hola:<?php echo $nombre ?? ''; ?></p>
    <a class="boton" href="/logout">Cerrar Sesión</a>
</div>


<?php if(isset($_SESSION['codigo_perfil'])) { ?>
    <div class="barra-solicitudes">
        <a class="boton" href="/admin">Ver Permisos</a>
        <a class="boton" href="/vacaciones">Ver Vacaciones</a>
        <a class="boton" href="/reportes">Reporte Permisos Pendiente</a>
        <a class="boton" href="/reporteV">Reporte Vacaciones Pendiente</a>
        <a class="boton" href="/reportePA">Permisos Aprobados</a>
    </div>
<?php } ?>