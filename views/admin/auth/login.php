<div class="auth">
    
    <div class="auth__contenedor">

        <p class="auth__nombre-pagina">Iniciar Sesion</p>

        <?php include_once __DIR__ . '/../../templates/alertas.php'; ?>

        <form action="/" class="auth__formulario" method="POST">
            <div class="auth__formulario--campo">
                <label for="correo">Correo</label>
                <input type="email" id="correo" name="correo" placeholder="Tu Email" value="<?php echo s($usuario->correo); ?>">
            </div>
            <div class="auth__formulario--campo">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" placeholder="Tu Password">
            </div>

            <input type="submit" class="auth__formulario--boton" value="Iniciar Sesion">
        </form>

        <div class="auth__acciones">
            <a href="/crear" class="auth__acciones--a">¿Aún no tienes una cuenta?</a>
            <a href="/olvide" class="auth__acciones--a">¿Olvidaste tu password?</a>
        </div>
    </div>
</div>