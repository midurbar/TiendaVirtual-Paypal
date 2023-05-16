<?php
    class Usuarios extends Controller
    {
        public function __construct() {
            parent::__construct();
            session_start();
        }
        public function index()
        {
            $data['title'] = 'usuarios';
            $this->views->getView('admin/usuarios', "index", $data);
        }
        public function listar()
        {
            $data = $this->model->getUsuarios();
            echo json_encode($data);
            die();
        }
    }
?>