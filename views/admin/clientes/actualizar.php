<div class="clientes">
    <div class="clientes__crear">
        <h1 class="nombre-pagina">Actualizar Cliente</h1>
        <p class="descripcion-pagina">Actualice los datos del cliente</p>
    
        <?php include_once __DIR__ . '/../../templates/alertas.php'; ?>
    
        <a href="/admin/clientes" class="clientes__a">Volver</a>
        <form action="" method="POST" class="clientes__form">
            <?php include_once __DIR__ . '/formulario.php'; ?>
    
            <input type="submit" class="clientes__form--boton" value="Actualizar Cliente">
        </form>
    </div>
</div>