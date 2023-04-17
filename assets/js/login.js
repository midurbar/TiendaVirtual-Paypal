const btnRegister=document.querySelector('#btnRegister');
const btnLogin=document.querySelector('#btnLogin');
const formLogin=document.querySelector('#formLogin');

const formRegister=document.querySelector('#formRegister');
const Registro=document.querySelector('#Registro');
const nombreRegistro=document.querySelector('#nombreRegistro');
const correoRegistro=document.querySelector('#correoRegistro');
const claveRegistro=document.querySelector('#claveRegistro');

document.addEventListener('DOMContentLoaded', function() {
    btnRegister.addEventListener('click', function () {
        formLogin.classList.add('d-none');
        formRegister.classList.remove('d-none');
    })
    btnLogin.addEventListener('click', function () {
        formRegister.classList.add('d-none');
        formLogin.classList.remove('d-none');
    })
    //registro
    Registro.addEventListener('click', function () {
        let formData = new FormData();
        formData.append('nombre', nombreRegistro.value);
        formData.append('correo', correoRegistro.value);
        formData.append('clave', claveRegistro.value);

        const http = new XMLHttpRequest();
        const url = base_url + 'clientes/registroDirecto';
        http.open('POST', url, true);
        http.send(formData);
        http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            Swal.fire('Aviso', res.msg, res.icono);
            if (res.icono=='success'){
                setTimeout(() => {
                    window.location.reload();
                }, 2000);
            }
        }
    }
    });
});

