<h1 class="nombre-pagina">Olvide la contraseña</h1>
<p class="descripcion-pagina">Reestablece tu contraseña colocando tu correo electronico coorporativo</p>

<?php 
    include_once __DIR__."/../templates/alertas.php";
?>

<form class="formulario" method="POST" action="/olvide">
    <div class="campo">
        <label for="email">Correo Electronico</label>
        <input type="email" id="email" name="email" placeholder="Ingresa Tu Correo Coorporativo">
    </div>

    <input type="submit" value="Enviar" class="boton">
</form>

<div class="acciones">
    <a href="/">Iniciar Sesión</a>
    <a href="/crearCuenta">Crear Cuenta</a>
</div>