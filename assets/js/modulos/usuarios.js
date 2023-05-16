

document.addEventListener('DOMContentLoaded', function() {

    $('#tblUsuarios').DataTable({
        ajax: {
          url: base_url + 'usuarios/listar',
          dataSrc: ''
        },
        columns: [
            { data: 'id' },
            { data: 'nombres' },
            { data: 'apellidos' },
            { data: 'correo' },
            { data: 'perfil' }
        ],
        language,
        dom,
        buttons
    });

})

