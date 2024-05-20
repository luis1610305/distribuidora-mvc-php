<div class="productos__form--campo">
    <label for="descripcion">Descripcion</label>
    <input type="text" name="descripcion" id="nombre" placeholder="Descripcion del Producto" value="<?php echo s($producto->descripcion) ?>">
</div>
<div class="productos__form--campo">
    <label for="codigo">Codigo</label>
    <input type="num" name="codigo" id="codigo" placeholder="Codigo del Producto" value="<?php echo s($producto->codigo) ?>">
</div>
<div class="productos__form--campo">
    <label for="precio">Precio</label>
    <input type="num" name="precio" id="precio" placeholder="Precio del Producto" value="<?php echo s($producto->precio) ?>">
</div>