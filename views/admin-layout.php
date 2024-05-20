<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Distribuidora XI MA SAC</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;700;900&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="/build/css/app.css">
</head>
<body>
    <header>
        <div class="barra">
            <p class="h-name">Distribuidora Xi Ma</p>
            <div class="nav">
                <a href="/admin/pedidos">Pedidos</a>
                <a href="/admin/productos">Productos</a>
                <a href="/admin/clientes">Clientes</a>
                <a href="/logout">Cerrar Sesión</a>
            </div>
        </div>
    </header>
    
    <main>
        <?php echo $contenido; ?>
    </main>

    <?php
        echo $script ?? '';
    ?>
</body> 
</html>