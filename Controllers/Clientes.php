<?php
    class Clientes extends Controller
    {
        public function __construct() {
            parent::__construct();
            session_start();
        }
        public function index()
        {
            $data['title'] = 'Tu Perfil';
            $this->views->getView('principal', "perfil", $data);
        }
        public function registroDirecto(){
            if(isset($_POST['nombre']) && isset($_POST['contraseña'])) {
                $nombre = $_POST['nombre'];
                $correo = $_POST['correo'];
                $cont = $_POST['contraseña'];
                $data = $this->model->registroDirecto($nombre, $correo, $cont);
            }
        }
        
    }
?>