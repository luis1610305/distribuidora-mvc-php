(function () {

    const pedido = {
        id: '',
        clienteId: '',
        fecha: '',
        productos: []
    }

    const pedidosProductos = [
        pedidoProducto = {
            pedidoId: '',
            productoId: '',
            cantidad: '',
            peso: ''
        }
    ]

    // console.log(pedidoProducto);

    let contadorFila = 1;
    let total = 0;
    const botonAgregar = document.querySelector('#botonAgregar');
    const botonQuitar = document.querySelector('#botonQuitar');

    botonAgregar.addEventListener('click', function () {
        agregarFila();
    });

    document.addEventListener('keydown', function (e) {
        if (e.code == 'F2') {
            agregarFila();
        }
    });

    botonQuitar.addEventListener('click', function () {
        quitarFila();
    });

    function agregarFila() {
        const tbody = document.querySelector('#tbody');
        const fila = document.createElement('TR');

        if ((tbody.childElementCount + 1) < contadorFila) {
            contadorFila--;
            console.log(tbody.childElementCount);
            console.log(contadorFila);
        }

        fila.innerHTML = `
        <td><input type="number" min="1" id="inputCodigo_${contadorFila}" idCod="${contadorFila}" tabindex="1"></td>
        <td><input type="text" disabled id="inputDescripcion_${contadorFila}"></td>
        <td><input type="number" min="1" tabindex="1"></td>
        <td><input type="number" min="1" id="inputPeso_${contadorFila}" idPes="${contadorFila}" tabindex="1"></td>
        <td><input type="number" id="inputPrecio_${contadorFila}" disabled></td>
        <td><input type="text" id="inputSubTotal_${contadorFila}" disabled value="S/ 0.00"></td>
        `;

        tbody.appendChild(fila);

        contadorFila++;
    }

    const tbody = document.querySelector('#tbody');

    tbody.addEventListener('focusin', function (e) {
        if (e.target.attributes.idCod) {
            let inputCodigo = document.querySelector(`#${e.target.id}`);

            if (!inputCodigo._listenersAdded) {
                inputCodigo._listenersAdded = true;

                inputCodigo.addEventListener('focusout', function (e) {
                    codigo = inputCodigo.value;
                    obtenerProducto(codigo, e.target.attributes.idCod.value);
                })
            }
        }
        if (e.target.attributes.idPes) {
            let inputPeso = document.querySelector(`#${e.target.id}`);

            if (!inputPeso._listenersAdded) {
                inputPeso._listenersAdded = true;
                
                inputPeso.addEventListener('keyup', function (e) {
                    if (e.code == 'NumpadEnter') {
                        calcularSubTotal(inputPeso, e);
                    }
                });
                inputPeso.addEventListener('focusout', function (e) {
                    calcularSubTotal(inputPeso, e);
                })
            }

        }
    });

    function calcularSubTotal(inputPeso, e) {
        let peso = inputPeso.value;
        let inputPrecio = document.querySelector(`#inputPrecio_${e.target.attributes.idPes.value}`);
        let precio = inputPrecio.value;

        let inputSubTotal = document.querySelector(`#inputSubTotal_${e.target.attributes.idPes.value}`);

        total = total - parseFloat(inputSubTotal.value.substring(3));

        subTotal = (precio * peso).toFixed(2);
        inputSubTotal.value = "S/ " + subTotal;

        let inputTotal = document.querySelector('#total');
        total = total + parseFloat(subTotal);
        inputTotal.value = "S/ " + total.toFixed(2);
    }

    function quitarFila() {
        const tbody = document.querySelector('#tbody');
        contadorFila = tbody.childElementCount;

        let inputSubTotal = document.querySelector(`#inputSubTotal_${contadorFila}`);
        let inputTotal = document.querySelector('#total');

        subTotal = inputSubTotal.value;
        total = inputTotal.value;

        total = parseFloat(total.substring(3)) - parseFloat(subTotal.substring(3));

        inputTotal.value = "S/ " + total.toFixed(2);

        tbody.removeChild(tbody.lastChild);
    }

    async function obtenerProducto(codigo, contadorFila) {
        const { productos } = pedido;
        const datos = new FormData();
        datos.append('codigo', codigo);
        try {
            const url = 'http://localhost:3000/api/pedido/obtenerProducto';
            const respuesta = await fetch(url, {
                method: 'POST',
                body: datos
            });
            const resultado = await respuesta.json();

            if (resultado.tipo === 'exito') {
                llenarFila(resultado.producto, contadorFila);
                pedido.productos = [...productos, resultado.producto];
            }

        } catch (error) {
            console.log(error)
        }
    }

    function llenarFila(producto, contadorFila) {
        const descripcion = document.querySelector(`#inputDescripcion_${contadorFila}`);
        descripcion.value = producto.descripcion;

        const precio = document.querySelector(`#inputPrecio_${contadorFila}`);
        precio.value = producto.precio;
    }

    const botonPedido = document.querySelector('#agregarPedido');
    botonPedido.onclick = agregarPedido;

    async function agregarPedido() {
        obtenerFecha();
        obtenerCliente();
        obtenerTotal();
        const { fecha, clienteId, total } = pedido;

        const datos = new FormData();
        datos.append('fecha', fecha);
        datos.append('clienteId', clienteId);
        datos.append('total', total);

        try {
            const url = 'http://localhost:3000/api/pedido/crear';
            const respuesta = await fetch(url, {
                method: 'POST',
                body: datos
            });

            const resultado = await respuesta.json();

            if(resultado.exito === 'exito') {
                pedidoProducto.pedidoId = pedidoId;
                agregarPedidoProducto();
            }
        } catch(error) {
            console.log(error);
        }
    }
    
    async function agregarPedidoProducto() {
        // const { pedidoId, productoId, cantidad, peso } = pedidoProducto;
        console.log(pedidoProducto.pedidoId); 
    }
    
    function obtenerFecha() {
        const fecha = document.querySelector('#fecha');
        pedido.fecha = fecha.value;
    }

    function obtenerCliente() {
        const cliente = document.querySelector('#cliente');
        pedido.clienteId = cliente.value;
    }

    function obtenerTotal() {
        const total = document.querySelector('#total');
        pedido.total = parseFloat(total.value.substring(3));
    }

})()