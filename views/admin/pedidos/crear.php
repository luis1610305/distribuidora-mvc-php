<div class="pedidos">
    <div class="pedidos__crear">
        <h1 class="nombre-pagina">Agregar Pedido</h1>
        <p class="descripcion-pagina">Ingrese los datos del nuevo Pedido</p>

        <a href="/admin/pedidos" class="pedidos__a">Volver</a>
        <div class="pedidos__form">
            <?php include_once __DIR__ . '/formulario.php'; ?>

            <input type="submit" class="pedidos__form--boton" value="Agregar Pedido" tabindex="4" id="agregarPedido">
        </div>
    </div>
</div>

<?php
$script = '
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="/build/js/pedidos_crear.js"></script>
'
?>