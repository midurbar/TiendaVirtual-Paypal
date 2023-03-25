const tableLista = document.querySelector("tableListaDeseo tbody");
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
            console.log(this.responseText);
        }
    }
}