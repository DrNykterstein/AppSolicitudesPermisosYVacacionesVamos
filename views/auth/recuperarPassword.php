<h1 class="nombre-pagina">Recuperar Contraseña</h1>
<p class="descripcion-pagina">Coloca tu nueva contraseña Compadre</p>

<?php 
    include_once __DIR__."/../templates/alertas.php";
?>


<?php if($error) return;?>
<form class="formulario" method="POST">
    <div class="campo">
        <label for="password">Contraseña</label>
        <input type="password" 
               id="password"
               name="password"
               placeholder="Escribe tu nueva contraseña"
        >
    </div>
    <input type="submit" class="boton" value="Guardar Nueva Contraseña">
</form>

<div class="acciones">
    <a href="/">Iniciar Sesión</a>
    <a href="/crearCuenta">Crear Cuenta Compadre</a>
</div>