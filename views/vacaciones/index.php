<h1 class="nombre-pagina">Panel de Administración</h1>

<?php
    include_once __DIR__.'/../templates/barra.php';
?>
<h2>Buscar Solicitudes de Vacaciones</h2>
<div class="busqueda">
    <form class="formulario">
        <div class="campo">
            <label for="fecha">Fecha</label>
            <input 
                type="date"
                id="fecha"
                name="fecha"
                value="<?php echo $fecha;?>"
            />
        </div>
    </form>
</div>

<div id="permisos-admin">
    <ul class="permisos">
        <?php
            foreach($vacaciones as $vacacione){            
        ?>
        <li>
            <p>Nombre: <span><?php echo $vacacione->nombre;?></span></p>
            <p>ID Vacaciones: <span><?php echo $vacacione->id_solicitud_vacaciones;?></span></p>
            <p>Fecha de Inicio: <span><?php echo $vacacione->fecha_inicio_vacaciones;?></span></p>
            <p>Culminacion del Permiso: <span><?php echo $vacacione->fecha_fin_vacaciones;?></span></p>
            <p>Tipo: <span><?php echo $vacacione->tipo_solicitud;?></span></p>
            <p>Estatus: <span>
                    <?php 
                        if($vacacione->estatus==0){
                            echo "Aprobado";
                        }else if($vacacione->estatus==2){
                            echo "Rechazado";
                        }else{
                            echo "Pendiente";
                        }
                    ?></span></p>
        </li>

        <form action="/vacaciones" method="POST">
            <input type="hidden"
                   name="idVacaciones"
                   value="<?php echo $vacacione->id_solicitud_vacaciones; ?>"
            />
            <input type="submit" class="boton-aprobar" value="Aprobar">
        </form>


        <form action="/vacaciones/rechazarVacaciones" method="POST">
            <input type="hidden"
                   name="idVacaciones"
                   value="<?php echo $vacacione->id_solicitud_vacaciones; ?>"
            />
            <input type="submit" class="boton-rechazar" value="Rechazar">
        </form>
        <?php }?>
    </ul>
</div>

<?php
    $script = "<script src='build/js/buscador.js'></script>"

?>