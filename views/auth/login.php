<h1 class="nombre-pagina">Gestion de Permisos y Vacaciones</h1>
<p class="descripcion-pagina">Inicia Sesión</p>

<?php 
    include_once __DIR__."/../templates/alertas.php";
?>

<form class="formulario" method="POST" action="/">
    <div class="campo">
        <label for="email">Email</label>
        <input 
            type="email"
            id="email"
            placeholder="Correo Electronico"
            name="email"
        />
    </div>

    <div class="campo">
        <label for="password">Contraseña</label>
        <input 
            type="password"
            id="password"
            placeholder="Tu contraseña"
            name="password"
        />
    </div>

    <input type="submit" class="boton" value="Iniciar Sesion">

</form>


<div class="acciones">
    <a href="/crearCuenta">Crear Cuenta</a>
    <a href="/olvide">Olvide Contraseña</a>
</div>
