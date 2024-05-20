<div class="pedidos__form--campoBox">
    <div class="pedidos__form--campo">
        <label for="fecha">Fecha</label>
        <input type="date" id="fecha" value="<?php echo date('Y-m-d', strtotime('-1 day')); ?>" disabled>
    </div>
    <div class="pedidos__form--campo">
        <label for="cliente">Cliente</label>
        <select name="clienteId" id="cliente">
            <option value="" disabled>--Seleccione--</option>
            <?php foreach ($clientes as $cliente) : ?>
                <option <?php echo $cliente->id === $pedido->clienteId ? 'selected' : ''; ?> value="<?php echo s($cliente->id) ?>">
                    <?php echo s($cliente->nombre) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="pedidos__form--campo">
        <div class="plus" id="botonAgregar">
            <i class="fa-solid fa-plus"></i>
        </div>
        <div class="minus" id="botonQuitar">
            <i class="fa-solid fa-minus"></i>
        </div>
    </div>
</div>
<table class="pedidos__form--table">
    <thead class="form__table--thead">
        <tr>
            <th>Código</th>
            <th>Descripción</th>
            <th>Cantidad</th>
            <th>Peso</th>
            <th>Precio</th>
            <th>SubTotal</th>
        </tr>
    </thead>
    <tbody class="form__table--tbody" id="tbody">
    </tbody>
    <tfoot class="form__table--tfoot">
        <tr>
            <td>Total</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td><input type="text" id="total" disabled></td>
        </tr>
    </tfoot>
</table>