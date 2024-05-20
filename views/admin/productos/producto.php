<h1 class="nombre-pagina">Producto</h1>
<p class="descripcion-pagina">Producto(s) relacionado a su busqueda</p>

<?php include_once __DIR__ . '/barra.php'; ?>

<ul class="card-box">
    <?php foreach ($productos as $producto) : ?>
        <li>
            <div class="li-info">
                <p>Descripcion: <span> <?php echo $producto->descripcion; ?> </span> </p>
                <p>Codigo: <span> <?php echo $producto->codigo; ?> </span> </p>
                <p>Precio: <span>S/ <?php echo $producto->precio; ?> </span> </p>
            </div>
            <div class="acciones">
                <a href="/productos/actualizar?id=<?php echo $producto->id; ?>" class="boton">Actualizar</a>
                <form action="/productos/eliminar" method="POST">
                    <input type="hidden" name="id" value="<?php echo $producto->id; ?>">
                    <input type="submit" class="boton-eliminar" value="Eliminar">
                </form>
            </div>
        </li>
    <?php endforeach; ?>
</ul>