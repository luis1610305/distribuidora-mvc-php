!function(){const t={id:"",clienteId:"",fecha:"",productos:[]};pedidoProducto={pedidoId:"",productoId:"",cantidad:"",peso:""};let e=1,o=0;const n=document.querySelector("#botonAgregar"),d=document.querySelector("#botonQuitar");function i(){const t=document.querySelector("#tbody"),o=document.createElement("TR");t.childElementCount+1<e&&(e--,console.log(t.childElementCount),console.log(e)),o.innerHTML=`\n        <td><input type="number" min="1" id="inputCodigo_${e}" idCod="${e}" tabindex="1"></td>\n        <td><input type="text" disabled id="inputDescripcion_${e}"></td>\n        <td><input type="number" min="1" tabindex="1"></td>\n        <td><input type="number" min="1" id="inputPeso_${e}" idPes="${e}" tabindex="1"></td>\n        <td><input type="number" id="inputPrecio_${e}" disabled></td>\n        <td><input type="text" id="inputSubTotal_${e}" disabled value="S/ 0.00"></td>\n        `,t.appendChild(o),e++}n.addEventListener("click",(function(){i()})),document.addEventListener("keydown",(function(t){"F2"==t.code&&i()})),d.addEventListener("click",(function(){!function(){const t=document.querySelector("#tbody");e=t.childElementCount;let n=document.querySelector("#inputSubTotal_"+e),d=document.querySelector("#total");subTotal=n.value,o=d.value,o=parseFloat(o.substring(3))-parseFloat(subTotal.substring(3)),d.value="S/ "+o.toFixed(2),t.removeChild(t.lastChild)}()}));function c(t,e){let n=t.value,d=document.querySelector("#inputPrecio_"+e.target.attributes.idPes.value).value,i=document.querySelector("#inputSubTotal_"+e.target.attributes.idPes.value);o-=parseFloat(i.value.substring(3)),subTotal=(d*n).toFixed(2),i.value="S/ "+subTotal;let c=document.querySelector("#total");o+=parseFloat(subTotal),c.value="S/ "+o.toFixed(2)}document.querySelector("#tbody").addEventListener("focusin",(function(e){if(e.target.attributes.idCod){let o=document.querySelector("#"+e.target.id);o._listenersAdded||(o._listenersAdded=!0,o.addEventListener("focusout",(function(e){codigo=o.value,async function(e,o){const{productos:n}=t,d=new FormData;d.append("codigo",e);try{const e="http://localhost:3000/api/pedido/obtenerProducto",i=await fetch(e,{method:"POST",body:d}),c=await i.json();"exito"===c.tipo&&(!function(t,e){document.querySelector("#inputDescripcion_"+e).value=t.descripcion;document.querySelector("#inputPrecio_"+e).value=t.precio}(c.producto,o),t.productos=[...n,c.producto])}catch(t){console.log(t)}}(codigo,e.target.attributes.idCod.value)})))}if(e.target.attributes.idPes){let t=document.querySelector("#"+e.target.id);t._listenersAdded||(t._listenersAdded=!0,t.addEventListener("keyup",(function(e){"NumpadEnter"==e.code&&c(t,e)})),t.addEventListener("focusout",(function(e){c(t,e)})))}}));document.querySelector("#agregarPedido").onclick=async function(){(function(){const e=document.querySelector("#fecha");t.fecha=e.value})(),function(){const e=document.querySelector("#cliente");t.clienteId=e.value}(),function(){const e=document.querySelector("#total");t.total=parseFloat(e.value.substring(3))}();const{fecha:e,clienteId:o,total:n}=t,d=new FormData;d.append("fecha",e),d.append("clienteId",o),d.append("total",n);try{const t="http://localhost:3000/api/pedido/crear",e=await fetch(t,{method:"POST",body:d});"exito"===(await e.json()).exito&&(pedidoProducto.pedidoId=pedidoId,async function(){console.log(pedidoProducto.pedidoId)}())}catch(t){console.log(t)}}}();