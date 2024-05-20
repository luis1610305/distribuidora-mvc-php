<div class="auth">

    <div class="auth__contenedor-olvide">
        <p class="auth__nombre-pagina">Recupera tu acceso a XIMA</p>

        <?php include_once __DIR__ . '/../../templates/alertas.php'; ?>

        <form action="/olvide" class="auth__formulario" method="POST">
            <div class="auth__formulario--campo">
                <label for="correo">Correo</label>
                <input type="email" id="correo" name="correo" placeholder="Tu Correo">
            </div>

            <input type="submit" class="auth__formulario--boton" value="Enviar Instrucciones">
        </form>

        <div class="auth__acciones">
            <a href="/" class="auth__acciones--a">¿Ya tienes una cuenta?</a>
            <a href="/crear" class="auth__acciones--a">¿Aún no tienes una cuenta?</a>
        </div>
    </div>
</div>