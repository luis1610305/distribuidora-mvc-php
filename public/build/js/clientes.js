!function(){!async function(){try{let n="/api/clientes";const i=await fetch(n),l=await i.json();e=l.clientes,t()}catch(e){console.log(e)}}();let e=[],n=[];function t(){!function(){const e=document.querySelector("#clientes__lista");for(;e.firstChild;)e.removeChild(e.firstChild)}();(n.length?n:e).forEach(n=>{const i=document.createElement("LI");i.dataset.clienteId=n.id,i.classList.add("lista__li");const l=document.createElement("P");l.classList.add("li__info--icon"),l.innerHTML='<i class="fa-solid fa-eye"></i>',l.onclick=function(){!function(e={}){const n=document.createElement("DIV");n.classList.add("modal"),n.innerHTML=`\n            <form class="clientes__form">\n                <legend>Información del Cliente</legend>\n                <div class="clientes__form--campo">\n                    <label>Nombre</label>\n                    <input type="text" name="nombre" placeholder="Nombre del Cliente" value="${e.nombre}" disabled>\n                </div>\n                <div class="clientes__form--campo">\n                    <label>Correo</label>\n                    <input placeholder="Correo del Cliente" value="${e.correo}" disabled>\n                </div>\n                <div class="clientes__form--campo">\n                    <label>Telefono</label>\n                    <input placeholder="Telefono del Cliente" value="${e.telefono}" disabled>\n                </div>\n                <div class="clientes__form--campo">\n                    <label>Direccion</label>\n                    <textarea placeholder="Direccion del Cliente"disabled rows="2">${e.direccion}</textarea>\n                </div>\n                <div class="clientes__form--campo">\n                    <label>Distrito</label>\n                    <input placeholder="Distrito del Cliente" value="${e.distrito}" disabled>\n                </div>      \n                <div class="opciones">\n                    <button type="button" class="cerrar-modal">Cancelar</button>\n                </div>\n            </form>\n        `,setTimeout(()=>{document.querySelector(".clientes__form").classList.add("animar")},0),n.addEventListener("click",(function(e){if(e.preventDefault(),e.target.classList.contains("cerrar-modal")){document.querySelector(".clientes__form").classList.add("cerrar"),setTimeout(()=>{n.remove()},300)}})),document.querySelector(".clientes").appendChild(n)}({...n})};const a=document.createElement("P");a.innerHTML=`Nombre: <span> ${n.nombre}</span> `;const o=document.createElement("P");o.innerHTML=`Telefono: <span> ${n.telefono}</span> `;const c=document.createElement("P");c.innerHTML=`Distrito: <span> ${n.distrito}</span> `;const s=document.createElement("DIV");s.classList.add("li__info"),s.appendChild(l),s.appendChild(a),s.appendChild(o),s.appendChild(c);const r=document.createElement("DIV");r.classList.add("li__acciones"),r.innerHTML=`<a href="/admin/clientes/actualizar?id=${n.id}" class="li__acciones--a">Actualizar</a>`;const d=document.createElement("DIV");d.innerHTML='<input type="submit" value="Eliminar" class="acciones--div__input">',d.onclick=function(){!function(n){Swal.fire({title:"¿Quieres Eliminar este Cliente?",icon:"warning",showCancelButton:!0,confirmButtonColor:"#3085d6",cancelButtonColor:"#d33",confirmButtonText:"Eliminar",cancelButtonText:"Cancelar"}).then(i=>{i.isConfirmed&&async function(n){const{id:i}=n,l=new FormData;l.append("id",i);try{const n="http://localhost:3000/api/cliente/eliminar",a=await fetch(n,{method:"POST",body:l});"exito"===(await a.json()).tipo&&(Swal.fire({title:"Eliminado!",text:"El Cliente ha sido eliminado",icon:"success"}),e=e.filter(e=>e.id!==i),t())}catch(e){console.log(e)}}(n)})}({...n})},r.appendChild(d),i.appendChild(s),i.appendChild(r);document.querySelector("#clientes__lista").appendChild(i)})}const i=document.querySelector("#buscador");i.addEventListener("keypress",(function(l){"13"==l.keyCode&&(palabra=i.value,n=e.filter(e=>e.nombre.toLowerCase().includes(palabra.toLowerCase())||e.distrito.toLowerCase().includes(palabra.toLowerCase())),t())}))}();