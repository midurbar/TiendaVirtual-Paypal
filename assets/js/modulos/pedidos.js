let tblPendientes;

var firstTabEl = document.querySelector('#myTab li:last-child button')
var firstTab = new bootstrap.Tab(firstTabEl)

document.addEventListener('DOMContentLoaded', function() {

    tblPendientes = $('#tblPendientes').DataTable({
        ajax: {
          url: base_url + 'pedidos/listar',
          dataSrc: ''
        },
        columns: [
            { data: 'id_transaccion' },
            { data: 'monto' },
            { data: 'estado' },
            { data: 'fecha' },
            { data: 'email' },
            { data: 'nombre' },
            { data: 'apellido' },
            { data: 'direccion' },
            { data: 'accion' }

        ],
        language,
        dom,
        buttons
    });
    
})



function eliminarProd(idProd) {
    Swal.fire({
        title: 'Aviso!',
        text: "Estas seguro de que quieres eliminar este registro?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, Eliminar!'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "productos/delete/" + idProd;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange= function() {
                if (this.readyState == 4 && this.status == 200) {
                    console.log(this.responseText);
                    const res = JSON.parse(this.responseText);
                    if (res.icono == 'success') {
                        tblProductos.ajax.reload();
                    }
                    Swal.fire('Aviso', res.msg.toUpperCase(), res.icono);
                }
            };
        }
    })
}