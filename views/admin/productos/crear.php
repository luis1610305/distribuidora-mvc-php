<div class="productos">
    <div class="productos__crear">
        <h1 class="nombre-pagina">Crear</h1>
        <p class="descripcion-pagina">Ingresa los datos del nuevo Producto</p>

        <?php include_once __DIR__ . '/../../templates/alertas.php'; ?>

        <a href="/admin/productos" class="productos__a">Volver</a>
        <form action="/admin/productos/crear" method="POST" class="productos__form">
            <?php include __DIR__ . '/formulario.php'; ?>

            <input type="submit" class="productos__form--boton" value="Registrar Producto">
        </form>
    </div>
</div>