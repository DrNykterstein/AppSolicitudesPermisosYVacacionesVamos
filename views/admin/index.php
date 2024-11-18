<h1 class="nombre-pagina">Panel de Administración</h1>

<?php
    include_once __DIR__.'/../templates/barra.php';
?>
<h2>Buscar Solicitudes de Permiso</h2>
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

<?php 
    if(count($permisos)===0){
        echo "<h2>No hay citas en esta fecha<h2>";
    }
?>

<div id="permisos-admin">
    <ul class="permisos">
        <?php
            foreach($permisos as $permiso){            
        ?>
        <li>
            <p>Nombre: <span><?php echo $permiso->nombre;?></span></p>
            <p>ID Permiso: <span><?php echo $permiso->id_solicitud_permiso;?></span></p>
            <p>Fecha de Inicio: <span><?php echo $permiso->fecha_inicio;?></span></p>
            <p>Dias de Duracion: <span><?php echo $permiso->duracion_permiso;?></span></p>
            <p>Culminacion del Permiso: <span><?php echo $permiso->fecha_culminacion;?></span></p>
            <p>Tipo: <span><?php echo $permiso->tipo_solicitud;?></span></p>
            <p>Estatus: <span>
                    <?php 
                        if($permiso->estatus==0){
                            echo "Aprobado";
                        }else if($permiso->estatus==2){
                            echo "Rechazado";
                        }else{
                            echo "Pendiente";
                        }
                    ?></span></p>
        </li>

        <form action="/api/aprobarPermisos" method="POST">
            <input type="hidden"
                   name="idPermiso"
                   value="<?php echo $permiso->id_solicitud_permiso; ?>"
            />
            <input type="submit" class="boton-aprobar" value="Aprobar">
        </form>

        <form action="/api/rechazarPermisos" method="POST">
            <input type="hidden"
                   name="idPermiso"
                   value="<?php echo $permiso->id_solicitud_permiso; ?>"
            />
            <input type="submit" class="boton-rechazar" value="Rechazar">
        </form>
        <?php }?>
    </ul>
</div>

<?php
    $script = "<script src='build/js/buscador.js'></script>"

?>