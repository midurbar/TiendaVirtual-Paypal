<?php
    class Admin extends Controller
    {
        public function __construct() {
            parent::__construct();
            session_start();
        }
        public function index() {
            $data['title'] = 'Acceso al sistema';
            $this->views->getView('admin', "login", $data);
        }
        public function validar() {
            if (isset($_POST['email']) && isset($_POST['clave'])) {
                if (empty($_POST['email']) || empty($_POST['clave'])) {
                    $respuesta = array('msg' => 'todos los campos son requeridos', 'icono' => 'warning');
                } else {

                }
            } else {
                $respuesta = array('msg' => 'error desconocido', 'icono' => 'error');
            }
            echo json_encode($respuesta);
            die();
        }
    }
?>