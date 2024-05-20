(function () {
    obtenerProductos();
    let productos = [];
    let filtrados = [];

    async function obtenerProductos() {
        try {
            let url = '/api/productos';
            const respuesta = await fetch(url);
            const resultado = await respuesta.json();

            productos = resultado.productos;
            mostrarProductos();
        } catch (error) {
            console.log(error)
        }
    }

    function mostrarProductos() {
        limpiarProductos();

        const arrayProductos = filtrados.length ? filtrados : productos;

        arrayProductos.forEach(producto => {
            const lista__li = document.createElement('LI');
            lista__li.dataset.productoId = producto.id;
            lista__li.classList.add('lista__li');

            const descripcionProducto = document.createElement('P');
            descripcionProducto.innerHTML = `Descripción: <span> ${producto.descripcion}</span> `;

            const codigoProducto = document.createElement('P');
            codigoProducto.innerHTML = `Código: <span> ${producto.codigo}</span> `;

            const precioProducto = document.createElement('P');
            precioProducto.innerHTML = `Precio: <span>S/ ${producto.precio}</span> `;

            const li__info = document.createElement('DIV');
            li__info.classList.add('li__info');

            li__info.appendChild(descripcionProducto);
            li__info.appendChild(codigoProducto);
            li__info.appendChild(precioProducto);

            const li__acciones = document.createElement('DIV');
            li__acciones.classList.add('li__acciones');

            //Botones
            li__acciones.innerHTML = `<a href="/admin/productos/actualizar?id=${producto.id}" class="li__acciones--a">Actualizar</a>`;

            const btnEliminar = document.createElement('DIV');
            btnEliminar.innerHTML = `<input type="submit" value="Eliminar" class="acciones--div__input">`;
            btnEliminar.onclick = function () {
                confirmarEliminarProducto({ ...producto });
            }

            li__acciones.appendChild(btnEliminar);

            lista__li.appendChild(li__info);
            lista__li.appendChild(li__acciones);

            const productosLista = document.querySelector('#productos__lista');
            productosLista.appendChild(lista__li);
        })
    }

    function limpiarProductos() {
        const productosLista = document.querySelector('#productos__lista');

        while (productosLista.firstChild) {
            productosLista.removeChild(productosLista.firstChild);
        }
    }

    const buscador = document.querySelector('#buscador');

    buscador.addEventListener('keypress', function (e) {
        let keycode = e.keyCode;
        if (keycode == '13') {
            palabra = buscador.value;
            filtrados = productos.filter((producto) => producto.descripcion.toLowerCase().includes(palabra.toLowerCase()) || producto.codigo.includes(palabra));
            mostrarProductos();
        }
    });

    function confirmarEliminarProducto(producto) {
        Swal.fire({
            title: "¿Quieres Eliminar este producto?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Eliminar",
            cancelButtonText: "Cancelar"
        }).then((result) => {
            if (result.isConfirmed) {
                eliminarProducto(producto);
            }
        });
    }

    async function eliminarProducto(producto) {
        const { id } = producto;

        const datos = new FormData();
        datos.append('id', id);

        try {
            const url = 'http://localhost:3000/api/producto/eliminar';
            const respuesta = await fetch(url, {
                method: 'POST',
                body: datos
            });

            const resultado = await respuesta.json();

            if (resultado.tipo === 'exito') {
                Swal.fire({
                    title: "Eliminado!",
                    text: "El Producto ha sido eliminado",
                    icon: "success"
                });

                productos = productos.filter(productoMemoria => productoMemoria.id !== id);
                mostrarProductos();
            }

        } catch (error) {
            console.log(error);
        }
    }
   
})()