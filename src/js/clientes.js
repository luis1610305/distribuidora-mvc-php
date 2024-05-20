(function () {
    obtenerClientes();
    let clientes = [];
    let filtrados = [];

    async function obtenerClientes() {
        try {
            let url = '/api/clientes';
            const respuesta = await fetch(url);
            const resultado = await respuesta.json();

            clientes = resultado.clientes;
            mostrarClientes();
        } catch (error) {
            console.log(error)
        }
    }

    function mostrarClientes() {
        limpiarClientes();

        const arrayClientes = filtrados.length ? filtrados : clientes;

        arrayClientes.forEach(cliente => {
            const lista__li = document.createElement('LI');
            lista__li.dataset.clienteId = cliente.id;
            lista__li.classList.add('lista__li');

            const icono = document.createElement('P');
            icono.classList.add('li__info--icon');
            icono.innerHTML = `<i class="fa-solid fa-eye"></i>`;
            icono.onclick = function () {
                mostrarModal({ ...cliente });
            }

            const nombreCliente = document.createElement('P');
            nombreCliente.innerHTML = `Nombre: <span> ${cliente.nombre}</span> `;

            const telefonoCliente = document.createElement('P');
            telefonoCliente.innerHTML = `Telefono: <span> ${cliente.telefono}</span> `;

            const distritoCliente = document.createElement('P');
            distritoCliente.innerHTML = `Distrito: <span> ${cliente.distrito}</span> `;

            const li__info = document.createElement('DIV');
            li__info.classList.add('li__info');


            li__info.appendChild(icono);
            li__info.appendChild(nombreCliente);
            li__info.appendChild(telefonoCliente);
            li__info.appendChild(distritoCliente);

            const li__acciones = document.createElement('DIV');
            li__acciones.classList.add('li__acciones');

            //Botones
            li__acciones.innerHTML = `<a href="/admin/clientes/actualizar?id=${cliente.id}" class="li__acciones--a">Actualizar</a>`;

            const btnEliminar = document.createElement('DIV');
            btnEliminar.innerHTML = `<input type="submit" value="Eliminar" class="acciones--div__input">`;
            btnEliminar.onclick = function () {
                confirmarEliminarCliente({ ...cliente });
            }

            li__acciones.appendChild(btnEliminar);

            lista__li.appendChild(li__info);
            lista__li.appendChild(li__acciones);

            const clientesLista = document.querySelector('#clientes__lista');
            clientesLista.appendChild(lista__li);
        })
    }

    function mostrarModal(cliente = {}) {
        const modal = document.createElement('DIV');
        modal.classList.add('modal');
        modal.innerHTML = `
            <form class="clientes__form">
                <legend>Información del Cliente</legend>
                <div class="clientes__form--campo">
                    <label>Nombre</label>
                    <input type="text" name="nombre" placeholder="Nombre del Cliente" value="${cliente.nombre}" disabled>
                </div>
                <div class="clientes__form--campo">
                    <label>Correo</label>
                    <input placeholder="Correo del Cliente" value="${cliente.correo}" disabled>
                </div>
                <div class="clientes__form--campo">
                    <label>Telefono</label>
                    <input placeholder="Telefono del Cliente" value="${cliente.telefono}" disabled>
                </div>
                <div class="clientes__form--campo">
                    <label>Direccion</label>
                    <textarea placeholder="Direccion del Cliente"disabled rows="2">${cliente.direccion}</textarea>
                </div>
                <div class="clientes__form--campo">
                    <label>Distrito</label>
                    <input placeholder="Distrito del Cliente" value="${cliente.distrito}" disabled>
                </div>      
                <div class="opciones">
                    <button type="button" class="cerrar-modal">Cancelar</button>
                </div>
            </form>
        `;

        setTimeout(() => {
            const formulario = document.querySelector('.clientes__form');
            formulario.classList.add('animar');
        }, 0);

        modal.addEventListener('click', function (e) {
            e.preventDefault();

            if (e.target.classList.contains('cerrar-modal')) {
                const formulario = document.querySelector('.clientes__form');
                formulario.classList.add('cerrar');
                setTimeout(() => {
                    modal.remove();
                }, 300);
            }
        })

        document.querySelector('.clientes').appendChild(modal);
    }

    function limpiarClientes() {
        const clientesLista = document.querySelector('#clientes__lista');

        while (clientesLista.firstChild) {
            clientesLista.removeChild(clientesLista.firstChild);
        }
    }

    const buscador = document.querySelector('#buscador');

    buscador.addEventListener('keypress', function (e) {
        let keycode = e.keyCode;
        if (keycode == '13') {
            palabra = buscador.value;
            filtrados = clientes.filter((cliente) => cliente.nombre.toLowerCase().includes(palabra.toLowerCase()) || cliente.distrito.toLowerCase().includes(palabra.toLowerCase()));
            mostrarClientes();
        }
    });

    function confirmarEliminarCliente(cliente) {
        Swal.fire({
            title: "¿Quieres Eliminar este Cliente?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Eliminar",
            cancelButtonText: "Cancelar"
        }).then((result) => {
            if (result.isConfirmed) {
                eliminarCliente(cliente);
            }
        });
    }

    async function eliminarCliente(cliente) {
        const { id } = cliente;

        const datos = new FormData();
        datos.append('id', id);

        try {
            const url = 'http://localhost:3000/api/cliente/eliminar';
            const respuesta = await fetch(url, {
                method: 'POST',
                body: datos
            });

            const resultado = await respuesta.json();

            if (resultado.tipo === 'exito') {
                Swal.fire({
                    title: "Eliminado!",
                    text: "El Cliente ha sido eliminado",
                    icon: "success"
                });

                clientes = clientes.filter(clienteMemoria => clienteMemoria.id !== id);
                mostrarClientes();
            }

        } catch (error) {
            console.log(error);
        }
    }

})()