<h1 class="nombre-pagina">Gestion de Permisos y de Vacaciones</h1>
<p class="descripcion-pagina">Elige tu solicitud</p>

<?php
    include_once __DIR__.'/../templates/barra.php';
?>

<div id="app">
    <nav class="tabs">
        <button type="button" class="actual" data-paso="1">Motivos</button>
        <button type="button" data-paso="2">Permiso</button>
        <button type="button" data-paso="3">Vacaciones</button>
        <button type="button" data-paso="4">Resumen Permiso</button>
        <button type="button" data-paso="5">Resumen Vacaciones</button>
    </nav>

    <div id="paso-1" class="seccion">
        <h2>Motivos</h2>
        <p class="text-center">Elige los motivos de tu Permiso</p>
        <div id="motivos" class="listado-motivos"></div>
    </div>
    <div id="paso-2" class="seccion">
        <h2>Solicita tu Permiso</h2>
        <p class="text-center">Coloca tus datos</p>

        <form class="formulario">
            <div class="campo">
                <label for="nombre">Nombre</label>
                <input type="text"
                       id="nombre"
                       placeholder="Tu nombre"
                       value="<?php echo $nombre;?>"
                       disabled 
                />
                <input type="hidden" id="miID" value="<?php echo $id_usuario; ?>"/>
            </div>

            <div class="campo">
                <label for="fecha_solicitud">Fecha Solicitud</label>
                <input type="date"
                       id="fecha_solicitud"
                       min="<?php echo date('Y-m-d');?>"
                />
            </div>

            <div class="campo">
                <label for="dias">Dias de permiso</label>
                <input type="number"
                       id="dias"
                       placeholder="Coloca el numero de dias del permiso"
                />
            </div>

            <div class="campo">
                <label for="fecha_inicio">Fecha de Inicio del Permiso</label>
                <input type="date"
                       id="fecha_inicio"
                       min="<?php echo date('Y-m-d');?>"
                />
            </div>

            <div class="campo">
                <label for="fecha_fin">Fecha de fin del Permiso</label>
                <input type="date"
                       id="fecha_fin"
                       min="<?php echo date('Y-m-d');?>"
                />
            </div>
        </form>
    </div>

    <div id="paso-3" class="seccion">
        <h2>Solicita tus Vacaciones</h2>
        <p class="text-center">Coloca tus datos</p>
        <form class="formulario formularioV">
            <div class="campo">
                <label for="nombre">Nombre</label>
                <input type="text"
                       id="nombre"
                       placeholder="Tu nombre"
                       value="<?php echo $nombre;?>"
                       disabled 
                />
            </div>

            <div class="campo">
                <label for="fecha_solicitud_vacaciones">Fecha de solicitud de Vacaciones</label>
                <input type="date"
                       id="fecha_solicitud_vacaciones"
                       min="<?php echo date('Y-m-d');?>"
                />
            </div>

            <div class="campo">
                <label for="fecha_inicio_vacaciones">Fecha de Inicio de las vacaciones</label>
                <input type="date"
                       id="fecha_inicio_vacaciones"
                       min="<?php echo date('Y-m-d');?>"
                />
            </div>

            <div class="campo">
                <label for="fecha_fin_vacaciones">Fecha de fin de las vacaciones</label>
                <input type="date"
                       id="fecha_fin_vacaciones"
                       min="<?php echo date('Y-m-d');?>"
                />
            </div>
        </form>
    </div>
    
    <div id="paso-4" class="seccion contenido-resumen">
        <h2>Resumeeeen</h2>
        <p class="text-center">Reportessss</p>
    </div>

    <div id="paso-5" class="seccion contenido-resumen-vacaciones">
        <h2>Reportes</h2>
        <p class="text-center">Reportessss</p>
    </div>



    <div class="paginacion">
        <button
            id="anterior"
            class="boton"
        >&laquo; Anterior</button>

        <button
            id="siguiente"
            class="boton"
        >Siguiente &raquo;</button>
    </div>
</div>

<?php 
    $script="
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script src='build/js/app.js'></script>
    ";
?>
