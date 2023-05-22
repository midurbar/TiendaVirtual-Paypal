const nuevo = document.querySelector('#nuevo_registro');
const frm = document.querySelector('#frmRegistro');
const btnAccion = document.querySelector('#btnAccion');
const titleModal= document.querySelector('#titleModal');
const myModal = new bootstrap.Modal(document.getElementById('nuevoModal'));

let tblCategorias;

document.addEventListener('DOMContentLoaded', function() {

    tblCategorias = $('#tblCategorias').DataTable({
        ajax: {
          url: base_url + 'categorias/listar',
          dataSrc: ''
        },
        columns: [
            { data: 'id' },
            { data: 'categoria' },
            { data: 'imagen' },
            { data: 'accion' }

        ],
        language,
        dom,
        buttons
    });
    //Cargar modal
    nuevo.addEventListener('click', function () {
        document.querySelector('#id').value = '';
        titleModal.textContent = 'NUEVA CATEGORIA';
        btnAccion.textContent = 'Registrar';
        frm.reset();
        myModal.show();
    })
    
    //Submit usuarios
    frm.addEventListener('submit', function(e){
        e.preventDefault();
        let data = new FormData(this);
        const url = base_url + "usuarios/registrar";
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(data);
        http.onreadystatechange= function() {
            if (this.readyState == 4 && this.status == 200) {
                console.log(this.responseText);
                const res = JSON.parse(this.responseText);
                if (res.icono == 'success') {
                    myModal.hide();
                    tblUsuario.ajax.reload();
                }
                Swal.fire('Aviso', res.msg.toUpperCase(), res.icono);
            }
        };
    })
})

function eliminarUser(idUser) {
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
            const url = base_url + "usuarios/delete/" + idUser;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange= function() {
                if (this.readyState == 4 && this.status == 200) {
                    console.log(this.responseText);
                    const res = JSON.parse(this.responseText);
                    if (res.icono == 'success') {
                        tblUsuario.ajax.reload();
                    }
                    Swal.fire('Aviso', res.msg.toUpperCase(), res.icono);
                }
            };
        }
    })
}

function editUser(idUser) {
    const url = base_url + "usuarios/edit/" + idUser;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange= function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            const res = JSON.parse(this.responseText);
            document.querySelector('#id').value = res.id;
            document.querySelector('#nombre').value = res.nombres;
            document.querySelector('#apellido').value = res.apellidos;
            document.querySelector('#correo').value = res.correo;
            document.querySelector('#clave').value = res.clave;
            document.querySelector('#clave').setAttribute('readonly', 'readonly');
            btnAccion.textContent = 'Actualizar';
            titleModal.textContent = 'MODIFICAR USUARIO';
            myModal.show();
        }
    };
}