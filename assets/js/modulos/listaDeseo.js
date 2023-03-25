const tableLista = document.querySelector("#tableListaDeseo tbody");
document.addEventListener('DOMContentLoaded', function() {
    getListaDeseo();
})

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
            res.forEach(producto => {
                html += `<tr>
                    <td>
                        <img class="img-thumbnail rounded-circle" src="${producto.imagen}" alt="" width="100">
                    </td>
                    <td>${producto.nombre}</td>
                    <td>${producto.precio}</td>
                    <td>${producto.cantidad}</td>
                    <td>
                        <button class="btn btn-danger" type="button"><i class="fas fa-trash"></i></button>
                        <button class="btn btn-info" type="button"><i class="fas fa-cart-plus"></i></button>
                    </td>
                </tr>`;
            });
            tableLista.innerHTML = html;
        }
    }
}