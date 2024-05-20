<div class="auth">
    <div class="auth__contenedor-reestablecer">
        <p class="auth__nombre-pagina">Coloca tu nuevo Password</p>

        <?php include_once __DIR__ . '/../../templates/alertas.php'; ?>

        <?php if($mostrar) :?>

            <form class="auth__formulario" method="POST">
                <div class="auth__formulario--campo">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Tu Password">
                </div>
                <div class="auth__formulario--campo">
                    <label for="password2">Repetir Password</label>
                    <input type="password" id="password2" name="password2" placeholder="Repite tu Password">
                </div>

                <input type="submit" class="auth__formulario--boton" value="Guardar Password">
            </form>

            <div class="auth__acciones">
                <a href="/" class="auth__acciones--a">Iniciar Sesion</a>
            </div>
        <?php endif; ?>
    </div>
</div>