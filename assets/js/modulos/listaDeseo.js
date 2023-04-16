const tableLista = document.querySelector("#tableListaDeseo tbody");
document.addEventListener('DOMContentLoaded', function() {
    getListaDeseo();
});

function getListaDeseo() {
    const http = new XMLHttpRequest();
    const url = base_url + 'principal/ListaDeseo';
    http.open('POST', url, true);
    http.send(JSON.stringify(listaDeseo));
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            console.log(res);
            let html = '';
            res.productos.forEach(producto => {
                html += `<tr>
                    <td>
                        <img class="img-thumbnail rounded-circle" src="${producto.imagen}" alt="" width="100">
                    </td>
                    <td>${producto.nombre}</td>
                    <td><span class="badge bg-warning">${producto.precio +' '+ res.moneda}</span></td>
                    <td><span class="badge bg-primary">${producto.cantidad}</span></td>
                    <td>
                        <button class="btn btn-danger btnEliminarDeseo" type="button" prod="${producto.id}"><i class="fas fa-trash"></i></button>
                        <button class="btn btn-info btnAddCart" type="button" prod="${producto.id}"><i class="fas fa-cart-plus"></i></button>
                    </td>
                </tr>`;
            });
            tableLista.innerHTML = html;
            btnEliminarDeseo();
            btnAgregarProducto();
        }
    }
}

function btnEliminarDeseo() {
    let listaEliminar = document.querySelectorAll('.btnEliminarDeseo');
    console.log(listaEliminar);
    for (let i =0 ; i< listaEliminar.length; i++) {
        listaEliminar[i].addEventListener('click', function(){
            let idProducto = listaEliminar[i].getAttribute('prod');
            eliminarListaDeseo(idProducto);
        })
    }
}

function eliminarListaDeseo(idProducto) {
    console.log(listaDeseo);
    for (let i=0; i< listaDeseo.length;i++) {
        if (listaDeseo[i].idProducto== idProducto) {
            listaDeseo.splice(i, 1);
        }
    }
    localStorage.setItem('listaDeseo',JSON.stringify(listaDeseo));
    getListaDeseo();
    cantidadDeseo();
    Swal.fire(
        'Aviso',
        'EL PRODUCTO YA ESTA BORRADO DE TU LISTA DE DESEOS',
        'success'
    )
}

//Agregar productos desde la lista de deseos

function btnAgregarProducto() {
    let listaAgregar = document.querySelectorAll('.btnAddCart');
    console.log(listaAgregar);
    for (let i =0 ; i< listaAgregar.length; i++) {
        listaAgregar[i].addEventListener('click', function(){
            let idProducto = listaAgregar[i].getAttribute('prod');
            agregarCarrito(idProducto, 1, true);
        })
    }
}