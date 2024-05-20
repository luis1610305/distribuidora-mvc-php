<h1 class="nombre-pagina">Cliente</h1>
<p class="descripcion-pagina">Cliente(s) relacionado a su busqueda</p>

<?php include_once __DIR__ . '/barra.php'; ?>

<ul class="card-box">
    <?php foreach ($clientes as $cliente) : ?>
        <li>
            <div class="li-info">
                <p>Nombre: <span> <?php echo $cliente->nombre; ?> </span> </p>
                <p>Correo: <span> <?php echo $cliente->correo; ?> </span> </p>
                <p>Telefono: <span> <?php echo $cliente->telefono; ?> </span> </p>
                <p>Direccion: <span> <?php echo $cliente->direccion; ?> </span> </p>
                <p>Distrito: <span> <?php echo $cliente->distritoId; ?> </span> </p>
                <p>Zona: <span> <?php echo $cliente->zonaId; ?> </span> </p>
            </div>
            <div class="acciones">
                <a href="/admin/clientes/actualizar?id=<?php echo $cliente->id; ?>" class="boton">Actualizar</a>
                <form action="/clientes/eliminar" method="POST">
                    <input type="hidden" name="id" value="<?php echo $cliente->id; ?>">
                    <input type="submit" class="boton-eliminar" value="Eliminar">
                </form>
            </div>
        </li>
    <?php endforeach; ?>
</ul>