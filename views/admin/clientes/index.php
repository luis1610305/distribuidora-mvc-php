<div class="clientes">
    <div class="clientes__index">
        <h1 class="nombre-pagina">Clientes</h1>
        <p class="descripcion-pagina">Lista de Clientes Registrados</p>

        <?php include_once __DIR__ . '/barra.php'; ?>

        <ul class="clientes__lista" id="clientes__lista">
            
        </ul>
    </div>
</div>

<?php 
$script = '
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="/build/js/clientes.js"></script>
';
?>