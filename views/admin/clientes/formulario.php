<div class="clientes__form--campo">
    <label for="nombre">Nombre</label>
    <input type="text" name="nombre" id="nombre" placeholder="Nombre del Cliente" value="<?php echo s($cliente->nombre) ?>">
</div>
<div class="clientes__form--campo">
    <label for="correo">Correo</label>
    <input type="email" name="correo" id="correo" placeholder="Correo del Cliente" value="<?php echo s($cliente->correo) ?>">
</div>
<div class="clientes__form--campo">
    <label for="telefono">Telefono</label>
    <input type="tel" name="telefono" id="nombre" placeholder="Telefono del Cliente" value="<?php echo s($cliente->telefono) ?>">
</div>
<div class="clientes__form--campo">
    <label for="direccion">Direccion</label>
    <input type="tel" name="direccion" id="direccion" placeholder="Direccion del Cliente" value="<?php echo s($cliente->direccion) ?>">
</div>
<div class="clientes__form--campo">
    <label for="distrito">Distrito</label>
    <select name="distritoId" id="distrito">
        <option value="" disabled>--Seleccione--</option>
        <?php foreach ($distritos as $distrito) : ?>
            <option <?php echo $distrito->id === $cliente->distritoId ? 'selected' : ''; ?> value="<?php echo s($distrito->id) ?>">
                <?php echo s($distrito->distrito) ?>
            </option>
        <?php endforeach; ?>
    </select>
</div>