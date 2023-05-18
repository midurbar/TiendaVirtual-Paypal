const nuevo = document.querySelector('#nuevo_registro');
const myModal = new bootstrap.Modal(document.getElementById('nuevoModal'));
const frm = document.querySelector('#frmRegistro');
const titleModal= document.querySelector('#titleModal');
let tblUsuario;

document.addEventListener('DOMContentLoaded', function() {

    tblUsuario = $('#tblUsuarios').DataTable({
        ajax: {
          url: base_url + 'usuarios/listar',
          dataSrc: ''
        },
        columns: [
            { data: 'id' },
            { data: 'nombres' },
            { data: 'apellidos' },
            { data: 'correo' },
            { data: 'perfil' },
            { data: 'accion' }

        ],
        language,
        dom,
        buttons
    });
    //Cargar modal
    nuevo.addEventListener('click', function () {
        titleModal.textContent = 'NUEVO USUARIO';
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
        }
    })
})

