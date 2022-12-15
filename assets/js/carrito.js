const btnAddDeseo = document.querySelectorAll('btnAddDeseo');
let listaDeseo= [];
document.addEventListener('DOMContentLoaded', function() {
    for (let i=0; i<btnAddDeseo.length; i++) {
        btnAddDeseo[i].addEventListener('click', function() {
            let idProducto = btnAddDeseo[i].getAttribute('prod');
            agregarDeseo(idProducto);
        });
    }
})

function agregarDeseo(idProd){
    listaDeseo.push({
        "idProducto": idProd,
        "cantidad": 1
    })
    localStorage.setItem('listaDeseo', JSON.stringify(listaDeseo));
}