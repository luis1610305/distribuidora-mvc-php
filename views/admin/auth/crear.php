<div class="auth">

    <div class="auth__contenedor-crear">
        <p class="auth__nombre-pagina">Crea tu cuenta</p>

        <?php include_once __DIR__ . '/../../templates/alertas.php'; ?>

        <form action="/crear" class="auth__formulario" method="POST">
            <div class="auth__formulario--campo">
                <label for="nombre">Nombre de Usuario</label>
                <input type="text" id="nombre" name="nombre" placeholder="Tu Nombre" value="<?php echo s($usuario->nombre); ?>">
            </div>
            <div class="auth__formulario--campo">
                <label for="email">Email</label>
                <input type="email" id="correo" name="correo" placeholder="Tu Email" value="<?php echo s($usuario->correo); ?>">
            </div>
            <div class="auth__formulario--campo">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" placeholder="Tu Password">
            </div>
            <div class="auth__formulario--campo">
                <label for="password2">Repetir Contraseña</label>
                <input type="password" id="password2" name="password2" placeholder="Repite tu Password">
            </div>

            <input type="submit" class="auth__formulario--boton" value="Crear Cuenta">
        </form>

        <div class="auth__acciones">
            <a href="/" class="auth__acciones--a">¿Ya tienes una cuenta? Iniciar Sesion</a>
            <a href="/olvide" class="auth__acciones--a">¿Olvidaste tu password?</a>
        </div>
    </div>
</div>