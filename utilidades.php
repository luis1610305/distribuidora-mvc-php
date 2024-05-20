<?php foreach ($productos as $producto) : ?>
                <li class="lista__li">
                    <div class="li__info">
                        <p>Descripcion: <span> <?php echo $producto->descripcion; ?> </span> </p>
                        <p>Codigo: <span> <?php echo $producto->codigo; ?> </span> </p>
                        <p>Precio: <span>S/ <?php echo $producto->precio; ?> </span> </p>
                    </div>
                    <div class="li__acciones">
                        <a href="/admin/productos/actualizar?id=<?php echo $producto->id; ?>" class="li__acciones--a">Actualizar</a>
                        <form action="/admin/productos/eliminar" method="POST" class="li__acciones--form">
                            <input type="hidden" name="id" value="<?php echo $producto->id; ?>">
                            <input type="submit" class="acciones--form__input" value="Eliminar">
                        </form>
                    </div>
                </li>
            <?php endforeach; ?>



            <?php foreach ($pedidos as $pedido) : ?>
                <li>
                    <p class="card-name">Nombre: <span> <?php echo $pedido->nombre; ?> </span> </p>
                    <div class="li__div">
                        <div class="li-info">
                            <p>Fecha: <span> <?php echo $pedido->fecha; ?> </span> </p>
                            <p>Cliente: <span> <?php echo $pedido->nombre; ?> </span> </p>
                            <p>Estado: <span> <?php echo $pedido->estado; ?> </span> </p>
                        </div>
                        <div class="acciones">
                            <a href="/pedidos/pedido?id=<?php echo $pedido->id; ?>" class="boton">Ver Pedido</a>
                            <a href="/pedidos/actualizar?id=<?php echo $pedido->id; ?>" class="boton">Actualizar</a>
                        </div>
                    </div>
                    <form action="/peididos/eliminar" method="POST">
                        <input type="hidden" name="id" value="<?php echo $pedido->id; ?>">
                        <input type="submit" class="boton-eliminar" value="Eliminar">
                    </form>
        
                </li>
            <?php endforeach; ?>
            