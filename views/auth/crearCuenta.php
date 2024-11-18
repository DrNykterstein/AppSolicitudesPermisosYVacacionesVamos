<h1 class="nombre-pagina">Crear Cuenta</h1>
<p class="descripción pagina">Llena el siguiente formulario para crear la cuenta en el sistema</p>


<?php 
    include_once __DIR__."/../templates/alertas.php";
?>

<form class="formulario" method="POST" action="/crearCuenta">
    <div class="campo">
        <label for="nombre">Nombre</label>
        <input type="text" id="nombre" name="nombre" placeholder="Tu nombre" 
                value="<?php echo s($usuario->nombre); ?>">
    </div>

    <div class="campo">
        <label for="apellido">Apellido</label>
        <input type="text" id="apellido" name="apellido" placeholder="Tu apellido"
                value="<?php echo s($usuario->apellido); ?>">
                
    </div>

    <div class="campo">
        <label for="cedula">Cedula</label>
        <input type="text" id="cedula" name="cedula" placeholder="Tu numero de cedula de identidad"
                value="<?php echo s($usuario->cedula); ?>">
    </div>

    <div class="campo">
        <label for="email">Correo</label>
        <input type="email" id="email" name="email" placeholder="Tu correo electronico coorporativo"
                value="<?php echo s($usuario->email); ?>">
    </div>

    <div class="campo">
        <label for="password">Contraseña</label>
        <input type="password" id="password" name="password" placeholder="Contraseña">
    </div>

    <div class="campo">
        <label for="antiguedad">Antiguedad</label>
        <input type="number" id="antiguedad" name="antiguedad" placeholder="Escriba los años de Antiguedad que tienes"
                value="<?php echo s($usuario->antiguedad); ?>">
    </div>

    <div class="campo">
        <label for="telefono">Telefono</label>
        <input type="tel" id="telefono" name="telefono" placeholder="Ingrese su número celular"
                value="<?php echo s($usuario->telefono); ?>">
    </div>

    <input type="submit" value="Crear Cuenta" class="boton">
</form>

<div class="acciones">
    <a href="/">Iniciar Sesión</a>
    <a href="/olvide">Olvide Contraseña</a>
</div>

