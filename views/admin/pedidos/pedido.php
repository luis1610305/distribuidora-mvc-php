<h1 class="nombre-pagina">Pedido</h1>
<p class="descripcion-pagina">Informacion del Pedido</p>

<?php include_once __DIR__ . '/barra.php'; ?>

<div class="card__pedido">
    <div class="card-name-box">
        <p class="card-name">Cliente: <span> <?php echo $pedidos[0]->cliente; ?> </span> </p>
        <p class="card-name">Fecha: <span> <?php echo $pedidos[0]->fecha; ?> </span> </p>
    </div>

    <table>
        <tr class="card-column">
            <td>Codigo</td>
            <td>Producto</td>
            <td>Cantidad</td>
            <td>Peso</td>
            <td>Precio</td>
            <td>Total</td>
        </tr>
        <?php foreach ($pedidos as $pedido) : ?>
            <tr class="card-row">
                <td><?php echo $pedido->codigo; ?></td>
                <td><?php echo $pedido->producto; ?></td>
                <td><?php echo $pedido->cantidad; ?></td>
                <td><?php echo $pedido->peso; ?></td>
                <td><?php echo $pedido->precio; ?></td>
                <td>S/<?php echo number_format($pedido->peso * $pedido->precio, 2); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>