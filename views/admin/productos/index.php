<div class="productos">
    <div class="productos__index">
        <h1 class="nombre-pagina">Productos</h1>
        <p class="descripcion-pagina">Lista de Productos Registrados</p>

        <?php include_once __DIR__ . '/barra.php'; ?>

        <ul class="productos__lista" id="productos__lista">
            
        </ul>
    </div>
</div>
<?php 
$script = '
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="../build/js/productos.js"></script>
';
?>