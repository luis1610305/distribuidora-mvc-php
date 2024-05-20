<div class="pedidos">
    <div class="pedidos__index">
        <h1 class="nombre-pagina">Pedido</h1>
        <p class="descripcion-pagina">Ingresa los datos del Pedido</p>
        
        <?php include_once __DIR__ . '/barra.php'; ?>
        
        <table class="pedidos__table">
            <thead class="pedidos__table--thead">
                <tr>
                    <th>Fecha de Emisión</th>
                    <th>Cliente</th>
                    <th>Estado</th>
                    <th>Deuda</th>
                    <th>Acciones</th> 
                </tr>
            </thead>
            <tbody class="pedidos__table--tbody">
                <?php foreach ($pedidos as $pedido) : ?>
                    <tr>
                        <td><?php echo $pedido->fecha; ?> </td>
                        <td><?php echo $pedido->nombre; ?></td>
                        <td><?php echo $pedido->estado; ?></td>
                        <td>S/ 1500</td>
                        <td class="table__body--acciones">
                            <a href="/pedidos/actualizar?id=<?php echo $pedido->id; ?>" class="boton">Actualizar</a>
                            <p>Eliminar</p>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot class="pedidos__table--tfoot">
                <tr>
                    <td>Total</td>
                    <td>2</td>
                    <td></td>
                    <td>S/3000</td>
                    <td></td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>